//#include <SoftwareSerial.h>

//SoftwareSerial mySerial(D7, D8);  // RX = 2, TX = 3

//void setup() {
  //Serial.begin(115200);      // Serial communication with PC
  //mySerial.begin(9600);   // Serial communication with ESP8266}

//void loop() {
  // String msg = mySerial.readStringUntil('\r');
   //Serial.println(msg);}}
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <SoftwareSerial.h>
#include <MFRC522.h>
#include <ArduinoJson.h>

#include<SoftwareSerial.h>


#define SS_PIN D2         // SDA / SS is connected to pinout D2
#define RST_PIN D1        // RST is connected to pinout D1

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Create MFRC522 instance.
WiFiClient client;
//SoftwareSerial softwareSerial(18, 19);  // SoftwareSerial for communication with Arduino Mega
//SoftwareSerial espSerial(18, 19); // RX, TX

const char* ssid = "Tp_link-322653";
const char* password = "12345678a";


ESP8266WebServer server(80);  // Server on port 80
String StrUID;
SoftwareSerial abc(D3,D4);
//------------------------------------SETUP-----------------------------------//

void setup() {
 // Serial.begin(115200);   // Initialize serial communications with the PC
  //abc.begin(9600);  // Initialize SoftwareSerial for communication with Arduino Mega
  
  Serial.begin(115200); // Initialize Serial Monitor
  abc.begin(9600); // Initialize ESP8266 Serial communication
  
  SPI.begin();            // Init SPI bus
  mfrc522.PCD_Init();     // Init MFRC522 card
  delay(500);
  WiFi.begin(ssid, password);  // Connect to your WiFi router
  Serial.println("");

 // pinMode(D3, OUTPUT);  // LED rouge
  //inMode(D8, OUTPUT);  // Buzzer

  //----------------------------------------Wait for connection
  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print("*");
    delay(500);
  }
  //----------------------------------------If successfully connected to the WiFi router, display the IP address
  Serial.println("");
  Serial.print("Successfully connected to: ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  Serial.println("Please tap the card!");
  Serial.println("");
}

//---------------------------------------------------------------------------------- ---//

//--------------------------------LOOP-----------------------------------------------//
void loop() {
 // Serial.println("xxxxx");
  //delay(1000);

   //abc.write("0");
  //delay(1000);
 
 //  abc.write(httpCode);
   //delay(1000);
  
  if (getCardUID()) {
    //digitalWrite(D3, HIGH);  // Turn on the LED rouge
    //tone(D8, 1000);  // Activate the buzzer with a frequency of 1000 Hz
    String cardUID = StrUID;
    sendUIDToServer(cardUID);
    //digitalWrite(D3, LOW);  // Turn off the LED rouge
    //noTone(D8);  // Disable the buzzer
  }
}

//-----------------------------------------------------------------------------------//

//----------------------------------------Procedure for reading and obtaining a UID from a card--------------------------------------------//
bool getCardUID() {
  byte readCard[4];
  char tempStrUID[32] = ""; // Renamed the local variable

  if (!mfrc522.PICC_IsNewCardPresent() || !mfrc522.PICC_ReadCardSerial()) {
    return false;
  }

  Serial.print("Card UID: ");
  for (int i = 0; i < 4; i++) {
    readCard[i] = mfrc522.uid.uidByte[i];
    arrayToString(readCard, 4, tempStrUID);
  }
  mfrc522.PICC_HaltA();
  
  StrUID = String(tempStrUID); // Assign the local variable to the global variable
  
  return true;
}

void arrayToString(byte arr[], unsigned int len, char buffer[]) {
  for (unsigned int i = 0; i < len; i++) {
    byte nib1 = (arr[i] >> 4) & 0x0F;
    byte nib2 = (arr[i] >> 0) & 0x0F;
    buffer[i * 2 + 0] = nib1 < 0xA ? '0' + nib1 : 'A' + nib1 - 0xA;
    buffer[i * 2 + 1] = nib2 < 0xA ? '0' + nib2 : 'A' + nib2 - 0xA;
  }
  buffer[len * 2] = '\0';
}

void sendUIDToServer(const String& cardUID) {
  HTTPClient http;
  String postData = "code2=" + cardUID;
  String url = "http://192.168.110.42:8000/check4/" + cardUID;
  http.begin(client, url);
  int httpCode = http.GET();
  String payload = http.getString();
  Serial.println("UID: " + cardUID);
  Serial.println("HTTP Code: " + String(httpCode));
  
  
   abc.write(String(httpCode).c_str());
   Serial.println("Payload: " + payload);
   
   //############################################################################################
 DynamicJsonDocument doc(512); // Adjust the size as per your requirements
DeserializationError error = deserializeJson(doc, payload);
 abc.write(String(payload).c_str());
if (error) {
  Serial.print("Error parsing JSON: ");
  Serial.println(error.c_str());
} else {
  const char* errorMessage = doc["error"];
  
  // Check if 'error' field exists in the JSON payload
  if (errorMessage) {
    String errorMessageString = String(errorMessage);
    int colonIndex = errorMessageString.indexOf(':');
    
    if (colonIndex != -1) {
      String statusString = errorMessageString.substring(colonIndex + 1);
      statusString.trim();
      
      Serial.print("Status: ");
      Serial.println(statusString);
    } else {
      Serial.println("Invalid error message format");
    }
  } else {
    Serial.println("Error field not found in JSON payload");
  }
}
  
 //#######################################################
  
  
  http.end();
  delay(700);


}
