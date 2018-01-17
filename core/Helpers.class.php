<?php

class Helpers
{
    /*
    Consigne : Vérification en amont de l'existence d'un fichier et dossier de log
    Ecriture dans ce fichier du contenu du message avec la date et l'heure
    */
    public static function createLogExist()
    {
        if (!is_dir("logs") && is_writable(".")) {
            mkdir("logs");
        }

        if (!file_exists("logs/logs.txt") && is_dir("logs")) {
            fopen("logs/logs.txt", "w");
        }
        return true;
    }

    public static function log($msg)
    {
        if (Helpers::createLogExist()) {
            $file = fopen("logs/logs.txt", "a") or die("Impossible d'ouvrir le fichier de logs");
            date_default_timezone_set("Europe/Paris");
            fwrite($file, date("Y-m-d H:i:s ").$msg."\r\n");
            fclose($file);
        }
    }

    // Coder la fonction mais ne pas l'appeler, on passera par un cron
    //
    public static function purgeLog()
    {
        if (Helpers::createLogExist() && filesize("logs/logs.txt") > 5000000) {
            $archive = fopen("logs/".date("Y-m-d").".txt", "a") or die("Impossible de créer l'archive");
            $logs = file_get_contents("logs/logs.txt");
            fwrite($archive, $logs);
            file_put_contents("logs/logs.txt", "");
        }
    }
}
