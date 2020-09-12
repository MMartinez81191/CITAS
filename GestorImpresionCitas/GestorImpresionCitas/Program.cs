using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GestorImpresionCitas
{
    class Program
    {
        static void Main(string[] args)
        {
            bool x = ConfiguracionInicial();
            Console.WriteLine("Introduzca un texto");
            String texto;
            texto = Console.ReadLine();
            Console.WriteLine("El texto introducido es: " + texto);
        }

        public static bool ConfiguracionInicial()
        {
            bool configuracionInicialTerminada = false;
            string directorioActual = Directory.GetCurrentDirectory();



            int counter = 0;
            string line;

            // Read the file and display it line by line.  
            System.IO.StreamReader file = new System.IO.StreamReader(directorioActual + "Ajustes.txt");
            while ((line = file.ReadLine()) != null)
            {
                System.Console.WriteLine(line);
                counter++;
            }

            file.Close();
            System.Console.WriteLine("There were {0} lines.", counter);
            // Suspend the screen.  
            System.Console.ReadLine();




            return configuracionInicialTerminada;
        }

    }
}
