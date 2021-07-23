<?php

require_once "ConnectToDatabase.php";

$conn = openConnectionToDatabase();

$venues = ["256 Wilmslow Road", "42's", "AXM", "Albert Hall",
           "Antwerp Mansion", "Apollo Theatre", "Ark Manchester",
           "Band on the Wall", "Black Dog Ballroom", "Bloom Nightclub",
           "Castlefield Bowl", "Club Liv Manchester", "Club Tropicana",
           "Contact Theatre", "Cruz 101", "Dive NQ", "Dulcimer", "EventCityUK",
           "FAC251 - Factory Manchester", "Fifth Nightclub", "Flour & Flagon",
           "Funkademia", "G-A-Y", "Gorilla ", "Gullivers", "Hallé St Peter's",
           "Hard Rock Cafe", "Heaton Park Concert Venue",
           "Hidden at Downtex Mill", "Hula", "Islington Mill", "Joshua Brooks",
           "K2 Karaoke Nightclub", "Kiki", "Kosmonaut", "Lock 91",
           "Lola Lo Manchester", "Lounge 31", "MOJO", "Manchester Academy",
           "Manchester Arena", "Manchester Bierkeller", "Manchester Central",
           "Mantra Live Mcr", "Martin Harris Centre for Music and Drama",
           "Matt & Phreds Jazz Club", "Mint Lounge", "Napoleons Night Club",
           "New York New York", "Night & Day Cafe", "O2 Ritz Manchester",
           "RNCM (Royal Northern College of Music)", "Rebellion Manchester",
           "Revolution Manchester,  Deansgate", "Revolution Manchester",
           "Oxford Road", "Satans Hollow", "Soup Kitchen", "South Club",
           "Star & Garter", "Suburbia Cocktail Co. of Manchester", "Suede",
           "The Alchemist", "The Birdcage", "The Bridgewater Hall",
           "The Comedy Store", "The Font", "The Liars Club", "The Live Room",
           "The Met", "The Printworks", "The Ruby Lounge", "The Stoller Hall",
           "The Temple", "The Thirsty Scholar", "The Warehouse Project",
           "The Whiskey Jar", "Tiger Tiger Manchester", "Tribeca",
           "Trof Northern Quarter", "Twenty Twenty Two", "Uber Lounge", "VOID",
           "Vanilla", "VinaBar Rogue & Bar Wave", "Viva Manchester",
           "Walrus Manchester", "﻿The Deaf Institute"];

    for ($rowIndex = 0; $rowIndex < count($array); $rowIndex ++)
    {
      $eachVenue = $venues[$rowIndex];
      $queryMySqli = "INSERT INTO Venue (`Name`) VALUES `".$eachVenue."` ";

      if (!$mysqli->query($queryMySqli))
      {
        echo "INSERT failed: (" . $mysqli->errno . ") " . $mysqli->error;
      }
    }

    closeConnectionToDatabase($mysqli);
?>

