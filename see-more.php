<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $reviews = [
        ['text' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi, hic. Aliquid, cupiditate sequi. Illo excepturi veniam at dignissimos ea repellat voluptatibus facilis sit, repellendus tempora expedita iusto accusantium provident reiciendis consequuntur porro impedit quia tenetur? Id dolorem totam ex voluptates ad atque? Ab, iure ipsa! Id sint atque rem, vitae labore voluptates asperiores quia quas! Libero dolorum facere ex natus architecto aperiam neque beatae nemo dicta quae, non a tempora veritatis. Ipsam ab doloremque accusantium dolore, at eligendi beatae sunt saepe quaerat nostrum dicta veritatis autem nihil quia veniam in rem nam pariatur ratione amet labore voluptatum. Alias maxime, odit sunt exercitationem corporis nihil consequuntur ex suscipit labore porro rerum dolor itaque blanditiis repellendus dicta adipisci magni, harum odio vitae ratione. Nihil commodi omnis voluptates, aliquam obcaecati nemo dolores perspiciatis architecto ipsum quod, ex, placeat similique! Sint vitae amet quibusdam vero qui placeat animi a dolore quasi nisi sequi itaque nobis delectus ipsam ad, quisquam aut! Hic sed minus exercitationem nemo a adipisci. Ipsam, qui architecto distinctio mollitia corporis accusamus beatae, iste sint voluptates molestias reiciendis. Quia harum ut illum, dolores eum temporibus exercitationem dolorum sed! Magni consequatur aliquam, totam, omnis, perferendis cupiditate quaerat maiores sed quibusdam repudiandae nostrum harum?'],
        ['text' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi, hic. Aliquid, cupiditate sequi. Illo excepturi veniam at dignissimos ea repellat voluptatibus facilis sit, repellendus tempora expedita iusto accusantium provident reiciendis consequuntur porro impedit quia tenetur? Id dolorem totam ex voluptates ad atque? Ab, iure ipsa! Id sint atque rem, vitae labore voluptates asperiores quia quas! Libero dolorum facere ex natus architecto aperiam neque beatae nemo dicta quae, non a tempora veritatis. Ipsam ab doloremque accusantium dolore, at eligendi beatae sunt saepe quaerat nostrum dicta veritatis autem nihil quia veniam in rem nam pariatur ratione amet labore voluptatum. Alias maxime, odit sunt exercitationem corporis nihil consequuntur ex suscipit labore porro rerum dolor itaque blanditiis repellendus dicta adipisci magni, harum odio vitae ratione. Nihil commodi omnis voluptates, aliquam obcaecati nemo dolores perspiciatis architecto ipsum quod, ex, placeat similique! Sint vitae amet quibusdam vero qui placeat animi a dolore quasi nisi sequi itaque nobis delectus ipsam ad, quisquam aut! Hic sed minus exercitationem nemo a adipisci. Ipsam, qui architecto distinctio mollitia corporis accusamus beatae, iste sint voluptates molestias reiciendis. Quia harum ut illum, dolores eum temporibus exercitationem dolorum sed! Magni consequatur aliquam, totam, omnis, perferendis cupiditate quaerat maiores sed quibusdam repudiandae nostrum harum?'],
        ['text' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi, hic. Aliquid, cupiditate sequi. Illo excepturi veniam at dignissimos'],
    ];

    foreach($reviews as $review) :
    
        $review_words = explode(" ", $review);
        $isLong_review = count($review_words) > 20;
        $shortReview = implode(" ", slice($review_words, 0, 20) . "...");
        
        ?>
        
        <?php if($isLong_review) : ?>
        <p class="gs-text bm-short-review"><?php echo $shortReview; ?><button class="bm-see-full-review-btn">See More</button></p>
        
        <?php else : ?>
        <p class="gs-text bm-full-review"><?php echo $review['text']; ?></p>
        <?php endif;
        
        endforeach; ?>


</body>
</html>

