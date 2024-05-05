<?php
generatePouvoire("Je veux invoque des eclaire foudroiant");
function generatePouvoire($userInput){

$API_KEY = "AIzaSyAXMrlFZpEgYbV96ficNxkZ3OpKVgv9jtM";

$data = [
    "contents" => [
        [
            "role" => "user",
            "parts" => [
                [
                    "text" => $userInput
                ]
            ]
        ],
        [
            "role" => "model",
            "parts" => [
                [
                    "text" => "## Sort : Manipulation Féline\n\n**Nom :** Manipulation Féline\n**Dommages :** 0 \n**Précision :** 75%\n**Cout en mana :** 3\n**Effet :** Permet de contrôler temporairement les actions d'un chat.  Le sort permet de lui faire effectuer des actions simples comme venir, partir, s'asseoir ou donner la patte. La durée et la complexité du contrôle dépendent de la concentration du lanceur et de la volonté du chat. \n**Eléments :** Lumière \n**Type :** Distance \n**Rareté :** 3"
                ]
            ]
        ],
        [
            "role" => "user",
            "parts" => [
                [
                    "text" => "Donne moi une détails pour une definition de magie :\n\"Avoir une super attaque dans les combat\"\nComme structure de réponse juste ces donne en reponse:\nNom : \"{value}\"\nDommages : \"{0 a 10}\"\nPrécision : \"{1% a 100%}\"\nCout en mana : \"{0 a 10}\"\nEffet : \"{description}\"\nEléments : \"{vent/feu/eau/terre/lumière/ténèbres}\"\n Type : \"{Mêlée ou distance}\"\nRarete : \"{1 a 5}\""
                ]
            ]
        ],
        [
            "role" => "model",
            "parts" => [
                [
                    "text" => "## Sort : Frappe Héroïque\n\n**Nom :** Frappe Héroïque\n**Dommages :** 8\n**Précision :** 80%\n**Cout en mana :** 5\n**Effet :** Concentre l'énergie du lanceur en une attaque physique puissante. L'attaque peut prendre différentes formes selon l'arme ou le style de combat du lanceur (coup de poing, coup d'épée, etc.). \n**Eléments :** Neutre (Peut être combiné avec d'autres éléments) \n**Type :** Mêlée \n**Rareté :** 2"
                ]
            ]
        ],
        [
            "role" => "user",
            "parts" => [
                [
                    "text" => "Je veux avoir une lance flamme"
                ]
            ]
        ],
        [
            "role" => "model",
            "parts" => [
                [
                    "text" => "## Sort : Souffle Ardent\n\n**Nom :** Souffle Ardent\n**Dommages :** 7 \n**Précision :** 65%\n**Cout en mana :** 4 \n**Effet :** Projette un cône de flammes sur les ennemis, infligeant des dégâts de feu sur la durée.  \n**Eléments :** Feu \n**Type :** Distance \n**Rareté :** 3"
                ]
            ]
        ],
        [
            "role" => "user",
            "parts" => [
                [
                    "text" => $userInput
                ]
            ]
        ]
    ],
    "generationConfig" => [
        "temperature" => 1,
        "topK" => 0,
        "topP" => 0.95,
        "maxOutputTokens" => 8192,
        "stopSequences" => []
    ],
    "safetySettings" => [
        [
            "category" => "HARM_CATEGORY_HARASSMENT",
            "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
        ],
        [
            "category" => "HARM_CATEGORY_HATE_SPEECH",
            "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
        ],
        [
            "category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT",
            "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
        ],
        [
            "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
            "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
        ]
    ]
];

$jsonData = json_encode($data);

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key={$API_KEY}");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($curl);
$response = json_decode($response, true);
// Check for errors
if(curl_error($curl)) {
    echo 'cURL error: ' . curl_error($curl);
} else {
    if ($response !== null) {
        if (isset($response['candidates']) && !empty($response['candidates'])) {
            $text = $response['candidates'][0]['content']['parts'][0]['text'];
            echo $text;
            spliteResult($text);
        } else {
            echo "No candidates found in the response.";
        }
    } else {
        echo "Failed to decode JSON response.";
    }
}
curl_close($curl);
}
function spliteResult($text){
     $parts = explode('**', $text);
     var_dump($parts);
     $nom = $parts[2];
     $dommages = $parts[4];
     $precision = $parts[6];
     $cout_en_mana = $parts[8];
     $effet = $parts[10];
     $elements = $parts[12];
     $type = $parts[14];
     $rarete = $parts[16];
    return [$nom,$dommages,$precision,$cout_en_mana,$effet,$elements,$type,$rarete];
}
?>