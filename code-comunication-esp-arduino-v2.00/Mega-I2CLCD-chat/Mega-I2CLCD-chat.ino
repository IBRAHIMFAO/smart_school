#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <SoftwareSerial.h>
#include <ArduinoJson.h>

// Function declaration
void displayLongSentence(String sentence);

LiquidCrystal_I2C lcd(0x27, 16, 2); // I2C LCD address may vary, adjust accordingly

SoftwareSerial espSerial(15,14); //RX  TX
 //SoftwareSerial espSerial(0,1); //RX  TX
 
int ledrouge =12;
int buzzer = 8;
int ledred =9;

void setup() {
  Serial.begin(9600); // Initialize Serial Monitor
  //lcd.begin(16, 2); // Initialize I2C LCD
  espSerial.begin(115200); // Initialize ESP8266 Serial communication

  while(!Serial);
  Serial.print("ccccccccccc");
  
  lcd.init();
  lcd.backlight(); // Turn on LCD backlight
  lcd.print("Arduino Mega");
  lcd.setCursor(0, 1);
  lcd.print("ESP8266 RX/TX");

  delay(2000);

  lcd.clear();
  lcd.print("Connecting...");

  //espSerial.println("Hello ESP8266"); // Send a test message to the ESP8266

  delay(2000);
  

}

void loop() {
  
  if (Serial.available()) {
    //String receivedValue = Serial.readString();
    //int httpCode = receivedValue.toInt();
  String httpCode = Serial.readString();
    

  
    // Print the received value to the serial monitor
    Serial.print("Received value: ");
    Serial.println(httpCode);
    lcd.clear();

//###############################################################################################33
  
 
  // Find the starting position of the JSON data
  int jsonStartIndex = httpCode.indexOf('{');
  if (jsonStartIndex != -1) {
    String jsonData = httpCode.substring(jsonStartIndex);

    StaticJsonDocument<200> doc;

    DeserializationError error = deserializeJson(doc, jsonData);

    if (error) {
      Serial.print("Failed to parse JSON data: ");
      Serial.println(error.c_str());
      return;
    }

    if (doc.containsKey("error")) {
      String errorMessage = doc["error"].as<String>();
      Serial.print("Error message: ");
      Serial.println(errorMessage);

        int codeIndex = httpCode.indexOf('{') - 3;
                        if (codeIndex >= 0 && codeIndex < httpCode.length()) {
                          int code = httpCode.substring(codeIndex, codeIndex + 3).toInt();
                  
                          if (code == 405) {
                            digitalWrite(ledrouge, HIGH);  // Turn on the red LED
                            //digitalWrite(ledrouge, HIGH);
                           tone(buzzer, 500); // Activate the buzzer with a frequency of 1000 Hz
                         Serial.print("CODE  ");
                        Serial.println(code);
                             displayLongSentence(errorMessage);
                             
                          //  digitalWrite(ledVertPin, LOW);    // Turn off the green LED
                          } else if (code == 404) {
                            digitalWrite(ledrouge, HIGH);    // Turn off the red LED
                           // digitalWrite(ledVertPin, HIGH);    // Turn on the green LED
                            tone(buzzer, 500);
                           Serial.print("CODE  ");
                        Serial.println(code);
                                   displayLongSentence(errorMessage);
                                     }
                          } 
                   // Check if the status information is present in the error message
                    int statusIndex = errorMessage.indexOf("status :");
                    if (statusIndex != -1) {
                      String status = errorMessage.substring(statusIndex + 8); // Extract status information
                      lcd.clear();
                     // lcd.print("Vous avez deja ete enregistre: " + status);
                      displayLongSentence(status + " est deja   enregistree");
                      if (status == "present" ) {
                         digitalWrite(ledrouge, HIGH);
                          tone(buzzer, 500); 
                      }if (status == "tardy" ) {
                         digitalWrite(ledrouge, HIGH);
                          tone(buzzer, 500); 
                      }
                      
                      
                      
                      }
                
    
    }
        
        if (doc.containsKey("next_session")) {
        String nextSession = doc["next_session"].as<String>();
        Serial.print("Next session: ");
        Serial.println(nextSession);
        displayLongSentence(nextSession);

        digitalWrite(ledrouge, HIGH);  // Turn on the red LED
        tone(buzzer, 500); // Activate the buzzer with a frequency of 1000 Hz
      
      }else if (doc.containsKey("success")) {
        String success = doc["success"].as<String>();
        Serial.print("  Etudiant est : ");
        Serial.println(success);
        displayLongSentence(success);

        digitalWrite(ledred, HIGH);  // Turn on the red LED
        tone(buzzer, 1000); // Activate the buzzer with a frequency of 1000 Hz
      }
      else {
    Serial.println("JSON data not found in the received value");
  }

  
       
    

//###################################################################################################
    

  //  if (httpCode == 405) {
    //  lcd.print("Etudiant non ");
   //   lcd.setCursor(0, 1);
    //  lcd.print("   trouve  ");
   //   digitalWrite(ledrouge, HIGH);
   //   tone(buzzer, 1000); // Activate the buzzer with a frequency of 1000 Hz
      
    //} else if (httpCode == 404) {
      //lcd.print("Aucune seance a");
  //    lcd.setCursor(0, 1);
   //   lcd.print(" venir trouve  ");
      
     // digitalWrite(ledrouge, HIGH);
  //    tone(buzzer, 1000); // Activate the buzzer with a frequency of 1000 Hz
  //  } else {
     // lcd.print("Scannez votre carte");
    // lcd.print("vide");
      //digitalWrite(led, LOW);
     // noTone(buzzer); // Disable the buzzer
 //   }
 // }
   delay(1000);
    digitalWrite(ledred, LOW);
    digitalWrite(ledrouge, LOW);  // Éteindre la LED rouge
    noTone(buzzer);  // Désactiver le buzzer
    delay(2000);
    lcd.clear();
    lcd.print("Scannez votre");
    lcd.setCursor(0, 1);
    lcd.print("   Carte  ");
    
  
  
  
  }  } }
  void displayLongSentence(String sentence) {
  
  // Check if the sentence is longer than 16 characters
  if (sentence.length() > 16) {
    String firstLine = sentence.substring(0, 16);
    String secondLine = sentence.substring(16);
    
    lcd.print(firstLine);
    lcd.setCursor(0, 1);
    lcd.print(secondLine);
  } else {
    lcd.print(sentence);
  }
}
   

// int state = Serial.parseInt();
  
  //if(state==404){
    //digitalWrite(12,LOW);
    //delay(3000);
    //digitalWrite(12,LOW);
    //Serial.println("command received : 1 , LED turen ");}
  
  //if(state==0){
    //digitalWrite(12,HIGH);
   // Serial.println("command received : 1 , LED turned SHOW "); }
  
  //String response = espSerial.readStringUntil('\r');
  //  Serial.println(response);
    
  
  //if (espSerial.available()) {
    //String response = espSerial.readStringUntil('\r');
    //Serial.println("Received response: " + response);

    //if (response.startsWith("Payload:")) {
      //lcd.clear();
      //lcd.print(response);}
