#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <SPI.h>
#include <MFRC522.h>
#define SS_PIN D2               //--> SDA / SS is connected to pinout D2
#define RST_PIN D1              //--> RST is connected to pinout D1
#define ON_Board_LED   2  //--> Defining an On Board LED, used for indicators when the process of connecting to a wifi router
MFRC522 mfrc522(SS_PIN, RST_PIN);  //--> Create MFRC522 instance.
WiFiClient client;
//---------------SSID and Password of your WiFi router---------------------------//
const char* ssid = "LA FENTAINE_TERRASE";
const char* password = "20232023";
//---------------------------------------------------------------------------------------------------//
//---------------SSID and Password of your WiFi router---------------------------//
//const char* ssid = "Tp_link-322653";
//const char* password = "12345678a";
//---------------------------------------------------------------------------------------------------//

ESP8266WebServer server(80);  //--> Server on port 80

byte readcard[4];
char str[32] = "";
String StrUID;

//------------------------------------SETUP-----------------------------------//

void setup() {
  Serial.begin(115200);  //--> Initialize serial communications with the PC
  SPI.begin();        //--> Init SPI bus
  mfrc522.PCD_Init(); //--> Init MFRC522 card
  delay(500);
  WiFi.begin(ssid, password); //--> Connect to your WiFi router
  Serial.println("");

  pinMode(ON_Board_LED, OUTPUT);
  digitalWrite(ON_Board_LED, HIGH); //--> Turn off Led On Board

  //----------------------------------------Wait for connection
  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print("*");
    //----------------------------------------Make the On Board Flashing LED on the process of connecting to the wifi router.
    digitalWrite(ON_Board_LED, LOW);
    delay(250);
    digitalWrite(ON_Board_LED, HIGH);
    delay(250);
  }
  digitalWrite(ON_Board_LED, HIGH); //--> Turn off the On Board LED when it is connected to the wifi router.
  //----------------------------------------If successfully connected to the wifi router, the IP Address that will be visited is displayed in the serial monitor
  Serial.println("");
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  Serial.println("Please put in the card!");
  Serial.println("");
}
//---------------------------------------------------------------------------------- ---//

//--------------------------------LOOP-----------------------------------------------//
void loop() {


  if ( getid()) {  /// iS the card present
    digitalWrite(ON_Board_LED, LOW);
    HTTPClient http;    //Declare object of class HTTPClient
    String postData;

    //Post Data
    postData = "code2=" + StrUID;

  //  http.begin(client,"http://192.168.61.421/TestServer/validate.php?code2="+StrUID);  //Specify request destination
       
        
        http.begin(client,"http://  192.168.0.168:8000/check4/"+StrUID);  //Specify request destination
                                             
    //http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header
    //                                                                      , text/plain
//http.addHeader("Content-Type", "application/plain");
    int httpCode = http.GET();   //Send the request
  String payload = http.getString();    //Get the response payload
 
    Serial.println("UID= "+StrUID);
    Serial.println(httpCode);   //Print HTTP return code
   Serial.println("payload= "+payload);    //Print request response payload
   
    http.end();  //Close connection
    delay(700);
    digitalWrite(ON_Board_LED, HIGH);
  }
}
//-----------------------------------------------------------------------------------//

//----------------------------------------Procedure for reading and obtaining a UID from a card or keychain--------------------------------------------//
int getid() {
  if (!mfrc522.PICC_IsNewCardPresent() || !mfrc522.PICC_ReadCardSerial() ) {
    return 0;
  }

 Serial.print("THE UID OF THE SCANNED CARD IS : ");

  for (int i = 0; i < 4; i++) {
    readcard[i] = mfrc522.uid.uidByte[i]; //storing the UID of the tag in readcard
    array_to_string(readcard, 4, str);
    StrUID = str;
  }
  mfrc522.PICC_HaltA();
  return 1;
}
//--------------------------------------------------------------------------------------//

//----------------------------------------Procedure to change the result of reading an array UID into a string-----------------------------------------------------------------------//
void array_to_string(byte arr[], unsigned int len, char buffer[]) {
  for (unsigned int i = 0; i < len; i++)
  {
    byte nib1 = (arr[i] >> 4) & 0x0F;
    byte nib2 = (arr[i] >> 0) & 0x0F;
    buffer[i * 2 + 0] = nib1  < 0xA ? '0' + nib1  : 'A' + nib1  - 0xA;
    buffer[i * 2 + 1] = nib2  < 0xA ? '0' + nib2  : 'A' + nib2  - 0xA;
  }
  buffer[len * 2] = '\0';
}
