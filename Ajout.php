 <?php                  
        
                 $nomcom=$_POST['nomcom'];
                 $nomscient=$_POST['nomscient'];
                 $famille=$_POST['famille'];
                 $taille=$_POST['taille'];
                 $origine=$_POST['origine'];
                 $temperature=$_POST['temperature'];
                 $ph=$_POST['ph'];
                 $durete=$_POST['durete'];
                 $zonedevie=$_POST['zonedevie'];
                 $description=$_POST['description'];
                 $esperancedevie=$_POST['esperancedevie'];
                 $comportement=$_POST['comportement'];
                 $reproduction=$_POST['reproduction'];
                 $dimorphisme=$_POST['dimorphisme'];
                 $dispo=$_POST['dispo'];
                 $prix=$_POST['prix'];
                 $image=$_POST['image'];
                 $litrageaqua=$_POST['litrageaqua'];
                 $maintenance=$_POST['maintenance'];
                 $quantite=$_POST['quantite'];
                 $typeeau=$_POST['typeeau'];
                 
                 
        try 
        {
            $bdd = new PDO('mysql:host=localhost;dbname=aquaservice',"root","");

        
        $req = $bdd->prepare('INSERT INTO `poissons`(`nom_commun`, `nom_scientifique`, `famille`, `taille`, `image`, `origine`, `type eau`, `temperature`, `ph`, `durete`, `zone de vie`, `description`, `esperance de vie`, `comportement`, `reproduction`, `dimorphisme`, `disponibilite`, `prix`, `taille aqua`, `facilite`, `quantite`) VALUES (:nomcom,:nomscient,:famille,:taille,:image,:origine,:typeeau,:temperature,:ph,:durete,:zonedevie,:description,:esperancedevie,:comportement,:reproduction,:dimorphisme,:dispo,:prix,:litrageaqua,:maintenance,:quantite)');
       
        $req->execute(array( 
                'nomcom' => $nomcom,
                'nomscient' => $nomscient,
                'famille' => $famille,
                'taille' => $taille, 
                'image' => $image,
                'origine' => $origine,
                'typeeau' => $typeeau,
                'temperature' => $temperature,
                'ph' => $ph,
                'durete' => $durete,
                'zonedevie' => $zonedevie,
                'description' => $description,
                'esperancedevie' => $esperancedevie,
                'comportement' => $comportement,
                'reproduction' => $reproduction,
                'dimorphisme' => $dimorphisme,
                'dispo' => $dispo,
                'prix' => $prix,
                'litrageaqua' => $litrageaqua,
                'maintenance' => $maintenance,
                'quantite' => $quantite
                 ));
        
        
        
         echo 'Le jeu a bien été ajouté !';
         header('location: admin.php'); 
        
      
         }
        catch(Exception $e)
        {
            die('ERREUR'. $e->getMessage());
        }
        
 
        ?>