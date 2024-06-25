<?php

   
function clean_encode_and_escape_text($text)
        {
            // Remplacer uniquement le caractère \f (saut de page) par un espace
            $cleaned_text = str_replace("\f", ' ', $text);
            // Convertir en UTF-8
            $encoded_text = mb_convert_encoding($cleaned_text, 'UTF-8', 'auto');
            // Remplacer les '?' par 'é'
            $replaced_text = str_replace('?', 'é', $encoded_text);
            // Échapper les caractères spéciaux HTML
            $escaped_text = htmlspecialchars($replaced_text, ENT_QUOTES, 'UTF-8');
            return $escaped_text;
        }
    function page1() {
        require("./Engine/connect.php");

       

        $sql = 'SELECT * from pokemon LIMIT 50';
        $select = $conn->prepare($sql);
        if ($select->execute()) {
            $results = $select->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($results as $pkmn) {
                $type = explode(', ', $pkmn['type']);
        ?>
                <article class="card-pkmn card<?= lcfirst($type[0]) ?>">
                    <div class="picture-pkmn" style="background-image: url('<?= $pkmn['image'] ?>');"></div>
                    <div class="data-pkmn <?= lcfirst($type[0]) ?>">
                        <h2><?= $pkmn['name'] ?>   n°<?= $pkmn['pokedexNumber'] ?></h2>
                        <div class="types-pkmn">
                            <p class="type <?= lcfirst($type[0]) ?>"><?= $type[0] ?></p>
                            <?php
                                if ($type[1] !== '') {
                                    ?>
                                    <p class="type <?= lcfirst($type[1]) ?>"><?= $type[1] ?></p>
                                    <?php
                                }
                            ?>
                        </div>
                        <blockquote><?= clean_encode_and_escape_text(strtolower($pkmn['description'])) ?></blockquote>
                        <!-- <audio controls class="cri">
                            <source src="<?= $pkmn['cri'] ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio> -->
                        <a href="/?c=pokemon&name=<?= $pkmn['name'] ?>">Voir</a>
                    </div>
                </article>
        <?php
            }
        }
       
    }

    function page2() {
        require("./Engine/connect.php");

        

        $sql = 'SELECT * from pokemon LIMIT 50 OFFSET 50';
        $select = $conn->prepare($sql);
        if ($select->execute()) {
            $results = $select->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($results as $pkmn) {
                $type = explode(', ', $pkmn['type']);
        ?>
                <article class="card-pkmn card<?= lcfirst($type[0]) ?>">
                    <div class="picture-pkmn" style="background-image: url('<?= $pkmn['image'] ?>');"></div>
                    <div class="data-pkmn <?= lcfirst($type[0]) ?>">
                        <h2><?= $pkmn['name'] ?>   n°<?= $pkmn['pokedexNumber'] ?></h2>
                        <div class="types-pkmn">
                            <p class="type <?= lcfirst($type[0]) ?>"><?= $type[0] ?></p>
                            <?php
                                if ($type[1] !== '') {
                                    ?>
                                    <p class="type <?= lcfirst($type[1]) ?>"><?= $type[1] ?></p>
                                    <?php
                                }
                            ?>
                        </div>
                        <blockquote><?= clean_encode_and_escape_text(strtolower($pkmn['description'])) ?></blockquote>
                        <!-- <audio controls class="cri">
                            <source src="<?= $pkmn['cri'] ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio> -->
                        <a href="/?c=pokemon&name=<?= $pkmn['name'] ?>">Voir</a>
                    </div>
                </article>
        <?php
            }
        }
       
    }


    

