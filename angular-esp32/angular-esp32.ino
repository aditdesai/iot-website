#include <WiFi.h>
#include <HTTPClient.h>
#include <WiFiClient.h>
#include <ArduinoJson.h>

const char* ssid = "ssid";
const char* password = "password";

const char* user = "user";
const char* pass = "pass";

String userId = "1";

HTTPClient http; 
WiFiClient wifiClient;

DynamicJsonDocument doc(1024);

void setup() 
{
  
  pinMode(4, OUTPUT);
  pinMode(5, OUTPUT);
  pinMode(12, OUTPUT);
  pinMode(13, OUTPUT);
  pinMode(14, OUTPUT);
  pinMode(15, OUTPUT);
  pinMode(18, OUTPUT);
  pinMode(19, OUTPUT);
  pinMode(21, OUTPUT);
  pinMode(22, OUTPUT);
  pinMode(23, OUTPUT);
  pinMode(25, OUTPUT);
  pinMode(26, OUTPUT);
  pinMode(27, OUTPUT);
  pinMode(32, OUTPUT);
  pinMode(33, OUTPUT);
  pinMode(34, OUTPUT);
  pinMode(35, OUTPUT);
  

  Serial.begin(115200);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) 
  {
    delay(200);
  }
  WiFi.setAutoReconnect(true);

  Serial.println("WiFi connected.");
  
  StaticJsonDocument<200> doc;
  // Add values in the document
  //
  doc["uname"] = user;
  doc["pw"] = pass;
  
  String requestBody;
  serializeJson(doc, requestBody);
  Serial.println(requestBody);
  http.begin("http://192.168.0.105/api/login.php/"); 
  int httpCode;
  while (true)
  {

    httpCode = http.POST(requestBody);   
    if (httpCode == 200)
      break;
    Serial.print(".");
    delay(1000);
  }
  Serial.println();
  Serial.println(httpCode);
  String response = http.getString();
  Serial.println(response);

  //StaticJsonDocument<200> doc;
  deserializeJson(doc, response);

  userId = doc["userid"].as<String>();
  Serial.println(userId);
  
}

void loop(){
  Serial.println(userId);
  StaticJsonDocument<200> doc;
  // Add values in the document
  //
  doc["userId"] = userId;
  
  String requestBody;
  serializeJson(doc, requestBody);
  Serial.println(requestBody);
  http.begin("http://192.168.0.105/api/read_esp32.php");  //Specify request destination
  http.addHeader("Content-Type", "application/json");
  http.addHeader("Accept", "*/*");
  
  int httpCode = http.POST(requestBody);  
  http.setTimeout(1000);
  
  String payload = http.getString();   //Get the request response payload
  Serial.println(payload);

  
  deserializeJson(doc, payload);
  http.end();  
  
  if (doc.containsKey("4"))
  {
    if(doc["4"] == "0")
      digitalWrite(4, LOW);
    if(doc["4"] == "1")
      digitalWrite(4, HIGH);
  }

  if (doc.containsKey("5"))
  {
    if(doc["5"] == "0")
      digitalWrite(5, LOW);
    if(doc["5"] == "1")
      digitalWrite(5, HIGH);
  }

  if (doc.containsKey("12"))
  {
    if(doc["12"] == "0")
      digitalWrite(12, LOW);
    if(doc["12"] == "1")
      digitalWrite(12, HIGH);
  }
  
  
  if (doc.containsKey("13"))
  {
    if(doc["13"] == "0")
      digitalWrite(13, LOW);
    if(doc["13"] == "1")
      digitalWrite(13, HIGH);
  }

  
  if (doc.containsKey("14"))
  {
    if(doc["14"] == "0")
      digitalWrite(14, LOW);
    if(doc["14"] == "1")
      digitalWrite(14, HIGH);
  }

  if (doc.containsKey("15"))
  {
    if(doc["15"] == "0")
      digitalWrite(15, LOW);
    if(doc["15"] == "1")
      digitalWrite(15, HIGH);
  }
  
  if (doc.containsKey("18"))
  {
    if(doc["18"] == "0")
      digitalWrite(18, LOW);
    if(doc["18"] == "1")
      digitalWrite(18, HIGH);
  }

  if (doc.containsKey("19"))
  {
    if(doc["19"] == "0")
      digitalWrite(19, LOW);
    if(doc["19"] == "1")
      digitalWrite(19, HIGH);
  }

  if (doc.containsKey("21"))
  {
    if(doc["21"] == "0")
      digitalWrite(21, LOW);
    if(doc["21"] == "1")
      digitalWrite(21, HIGH);
  }
  
  if (doc.containsKey("22"))
  {
    if(doc["22"] == "0")
      digitalWrite(22, LOW);
    if(doc["22"] == "1")
      digitalWrite(22, HIGH);
  }

  if (doc.containsKey("23"))
  {
    if(doc["23"] == "0")
      digitalWrite(23, LOW);
    if(doc["23"] == "1")
      digitalWrite(23, HIGH);
  }

  if (doc.containsKey("25"))
  {
    if(doc["25"] == "0")
      digitalWrite(25, LOW);
    if(doc["25"] == "1")
      digitalWrite(25, HIGH);
  }
  
  if (doc.containsKey("26"))
  {
    if(doc["26"] == "0")
      digitalWrite(26, LOW);
    if(doc["26"] == "1")
      digitalWrite(26, HIGH);
  }

  if (doc.containsKey("27"))
  {
    if(doc["27"] == "0")
      digitalWrite(27, LOW);
    if(doc["27"] == "1")
      digitalWrite(27, HIGH);
  }

  if (doc.containsKey("32"))
  {
    if(doc["32"] == "0")
      digitalWrite(32, LOW);
    if(doc["32"] == "1")
      digitalWrite(32, HIGH);
  }
  
  if (doc.containsKey("33"))
  {
    if(doc["33"] == "0")
      digitalWrite(33, LOW);
    if(doc["33"] == "1")
      digitalWrite(33, HIGH);
  }

  if (doc.containsKey("34"))
  {
    if(doc["34"] == "0")
      digitalWrite(34, LOW);
    if(doc["34"] == "1")
      digitalWrite(34, HIGH);
  }

  if (doc.containsKey("35"))
  {
    if(doc["35"] == "0")
      digitalWrite(35, LOW);
    if(doc["35"] == "1")
      digitalWrite(35, HIGH);
  }
  
  
  

   
}