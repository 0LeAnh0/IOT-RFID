#include <Arduino.h>
#include <iostream>
#include <WiFi.h>
#include <SPI.h>
#include <MFRC522.h>
#include <PubSubClient.h>
#include <HTTPClient.h>
#include <WebServer.h>
#define Miso 19
#define Mosi 23
#define Sck 18
#define Sda 5
#define Rst 22

// Tạo ra đối tượng MFRC522
const char* ssid = "ok";
const char* password = "tqnguyen";
String apikey = "esp3212345";
#define MQTT_SERVER "broker.mqttdashboard.com"
#define MQTT_PORT 1883
#define MQTT_USER "storage"
#define MQTT_PASSWORD "123456"

WiFiClient wifiClient;
PubSubClient client(wifiClient);

MFRC522 mfrc522(Sda, Rst);
String Id = "";
String card;

void wificonnect()
{
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println("Connecting to WiFi..");
  }
  Serial.println(WiFi.localIP());
}

//MQTT
void connect_to_broker() {
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    String clientId = "IoTBTL";
    clientId += String(random(0xffff), HEX);
    if (client.connect(clientId.c_str(), MQTT_USER, MQTT_PASSWORD)) {
      Serial.println("connected");
      client.subscribe("esp32/rfidstorage");
    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 2 seconds");
      delay(2000);
    }
  }
}

void callback(char* topic, byte* payload, unsigned int length) {
  Serial.println("-------new message from broker-----");
  Serial.print("topic: ");
  Serial.println(topic);

  Serial.print("Callback - ");
  Serial.print("Message:");
  for (int i = 0; i < length; i++) {
    Serial.print((char)payload[i]);
  }
}

String check;
void SendData() {
  Serial.println("Sending data to server ...");
  HTTPClient http;
  http.begin("http://192.168.166.43/storate/esppostdata.php");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  String httpRequestData = "api_key=" + apikey + "&id=" + card;

  int httpResponseCode = http.POST(httpRequestData);
  if (httpResponseCode > 0) {
    String response = http.getString();
    Serial.println(httpResponseCode);
    Serial.println(response);
    check = response;
  } else {
    Serial.print("Error on sending POST: ");
    Serial.println(httpResponseCode);
    check = httpResponseCode;
  }
  http.end();
}

String readrfid() {
  if (!mfrc522.PICC_IsNewCardPresent()) {
    return "";
  }
  if (!mfrc522.PICC_ReadCardSerial()) {
    return "";
  }
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    Id.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
    Id.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  Id.toUpperCase();

  card = Id;
  Id = "";
  Serial.println(card);

  return card;
}

void run() {

  while (readrfid() == "") {
    readrfid();
    delay(200);
  }
  Serial.println("Read_RF");
  client.loop();
  if (!client.connected()) {
    connect_to_broker();
  }

  SendData();
  if (check != "1") {
    Serial.println("server down");
    SendData();
  }
  Serial.println("test reponse");
  Serial.println(check);
  delay(2000);
}

void setup() {
  Serial.begin(115200);  // Khởi tạo Serial communication
  SPI.begin();           // Khởi tạo  SPI bus
  mfrc522.PCD_Init();    // Khởi tạo MFRC522
  Serial.println("Place your card near the reader...");
  wificonnect();
  client.setServer(MQTT_SERVER, MQTT_PORT);
  client.setCallback(callback);
  connect_to_broker();
}

void loop() {
  run();
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    Serial.println("Card detected!");
    // In ra dữ liệu của thẻ
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
      Serial.print(mfrc522.uid.uidByte[i], HEX);
    }
    Serial.println();
    mfrc522.PICC_HaltA();
  }
}