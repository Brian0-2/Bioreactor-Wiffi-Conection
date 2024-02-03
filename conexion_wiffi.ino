#include<ESP8266WiFi.h>

//Parametros a necesitar
const char * nombreRed = "Casa Valdivia"; //nombre de red
const char * password = "TValdivia4"; //clave de la red
const char * host = "biorect.com";//ip de mi computadora o dominio

//Variables a imprimir
float temperatura = 0;
int ph = 0;
int contador = 1;

void setup() {

  Serial.begin(115200);
  Serial.println();

  Serial.printf("Connecting to %s ... ", nombreRed);
  WiFi.begin(nombreRed, password);
  while (WiFi.status() != WL_CONNECTED) {

    delay(300);
    Serial.print(".");

  }

  Serial.println("Wiffi conectado");
  //Serial.println(WiFi.localIP());
}

void loop()
{
  WiFiClient client;

  Serial.printf("\n[Connectando a %s ...]", host);
  if (client.connect(host, 80))
  {
    Serial.println("[conectado]");

    temperatura ++;
    ph ++;
    contador++;
    Serial.println("[Seading a request]");
    client.print(String("GET /obtenerdatos.php/?Temp=") + temperatura + "&Ph=" + ph + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n" +
                 "\r\n"
                );


    Serial.println("[Response:]");
    while (client.connected()) {

      if (client.available()) {

        String line = client.readStringUntil('\n');
        Serial.println(line);
      }
    }
    client.stop();
    Serial.println("\n[Disconnected]");
  }
  else {
    Serial.println("connection failed!");
    client.stop();
  }
  delay(2000);
}
