#include <Ethernet.h> 

//Initialise LED Pin
int led = 7;
boolean LEDStatus = false;

//Initialise Motion Sensor
int sensor = 8; 

//Initialise Sound Sensor
int Ssensor = 5;

//Internet Configuration
// Set to any mac address
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

// Put the IP address for your server
IPAddress webServerIP(192,168,0,100);    
  
// Set the static IP address to use for Arduino client
IPAddress clientIP(192,168,0,101);
  
// Used for connecting to web server
EthernetClient client;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  Ethernet.begin(mac, clientIP);
  Serial.println("Starting Program ...");

  //Motion Pin is 8
  pinMode(sensor, INPUT);
  //Sound Pin is 5
  pinMode(Ssensor, INPUT);
  //Led Pin is 7
  pinMode(led, OUTPUT);
}

void loop() {
  activateSoundSensor();
  activateMotionSensor();
}

void activateSoundSensor(){
  int SensorData = digitalRead(Ssensor); 
  if(SensorData == 1){

    if(LEDStatus == false){
        digitalWrite(led, HIGH);
        delay(700);
        Serial.println("Status: ON");
        String LightStatus = """ON""";
        
        LEDStatus = true;
        
        String sensorsData="sensor2="+String(LightStatus);
        httpRequest("GET /pervasive2/add_sound.php?"+sensorsData+" HTTP/1.0");
    }
    else{
        digitalWrite(led, LOW);
        delay(1000);
        Serial.println("Status: OFF");
        String LightStatus = """OFF""";
        LEDStatus = false;
        String sensorsData="sensor2="+String(LightStatus);
        httpRequest("GET /pervasive2/add_sound.php?"+sensorsData+" HTTP/1.0");
    }
  }
}

void activateMotionSensor(){
  long state = digitalRead(sensor);

  if(state == HIGH) {
    //Turn On Led
    digitalWrite(led, HIGH);
    
    Serial.println("Motion detected!");
    String movement = """MovementDetected""";

    LEDStatus = true;
    
    String sensorsData="sensor1="+String(movement);
    httpRequest("GET /pervasive2/add_motion.php?"+sensorsData+" HTTP/1.0");

    //Turns on for 10 minutes
    delay(100000);
    digitalWrite(led, LOW); 
    LEDStatus = false;     
  }   
}

/*WiFi Connection*/
void httpRequest(String request) 
{
/*---connect the "Arduino" as client to the web server---*/ 
   if (client.connect(webServerIP,80)) {  //connect the "Arduino" as client to the web server using socket   
      Serial.println("connected.");
      Serial.println("sending data to web server...");      
      Serial.println(request);
      Serial.println("Connection: close"); // telling the server that we are over transmitting the message
      Serial.println(); // empty line
/*----send sensors data to the web server using GET request---*/ 
      client.println(request);
      client.println("Connection: close"); // telling the server that we are over transmitting the message
      client.println();                    // empty line
/*----display the response message from the server------------*/
      httpResponse();
    }
    else {
/*---if Arduino can't connect to the server----------*/
      Serial.println("--> connection failed\n");
      while (true);                          // do nothing forevermore
    }
    if (client.connected()) { 
      client.stop();                         // close communication socket 
    }
}

void httpResponse() 
{
  // if there are incoming bytes available
  // from the server, read them and print them:
  if (client.available()) {
    char c = client.read();
    Serial.print(c);
  }

  if (!client.connected()) {
    Serial.println();
    Serial.println("disconnecting.");
    client.stop();    // closing connection to server
  } 
}
