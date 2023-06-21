<?php 
    
?>


<!DOCTYPE html>
<html lang="en" spellcheck="false">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verbind</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
         <ul>
            <li class="page selected"><a class="fa-solid fa-home" href="home.php"></a></li>
            <li class="page"><a class="fa-solid fa-search" href="search.php"></a></li>
            <li class="page"><a class="fa-solid fa-comment-dots" href="messages.php"></a></li>
            <li class="page"><a class="fa-solid fa-bell" href="notifs.php"></a></li>
            <li class="page"><a class="fa-solid fa-user" href="profile.php"></a></li>
         </ul>
    </header>
<section id="content">
<div id="discover">
    <h1>People you may know:</h1>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>

    <button onclick="window.location.replace('search.php')"><i class="fa-solid fa-search"></i> more users</button>
</div>    

<div id ="feed">
    <div class="make">
        <div id="textarea" contenteditable placeholder="write something..." spellcheck="false"></div>
      <div class="inter">
        <div><i class="fa-solid fa-camera"></i> Add image</div>
        <div><i class="fa-solid fa-share"></i> Share</div>
       </div>
    </div>
    <div class="f-element">
        <div class="person">
            <div>
            <img src="images/Account.png" alt="">
            <span>first last</span>
            </div>
            <i class="fa-solid fa-ellipsis-v"></i>
        </div>
        <span style="margin: 2px;">&nbsp;</span>
        <img src="images/example.jpeg" alt="">
        <div class="inter">
            <div><i class="fa-solid fa-thumbs-up"></i> Like</div>
            <div><i class="fa-solid fa-comment"></i> Comment</div>
            <div><i class="fa-solid fa-share"></i> Share</div>
        </div>
    </div>
    <div class="f-element">
        <div class="person">
            <div>
            <img src="images/Account.png" alt="">
            <span>first last</span>
            </div>
            <i class="fa-solid fa-ellipsis-v"></i>
        </div>
        <span style="margin: 2px;"> Today is a great day </span>
        <img src="" alt="">
        <div class="inter">
            <div><i class="fa-solid fa-thumbs-up"></i> Like</div>
            <div><i class="fa-solid fa-comment"></i> Comment</div>
            <div><i class="fa-solid fa-share"></i> Share</div>
        </div>
    </div>
    <div class="f-element">
        <div class="person">
            <div>
            <img src="images/Account.png" alt="">
            <span>first last</span>
            </div>
            <i class="fa-solid fa-ellipsis-v"></i>
        </div>
        <span style="margin: 2px;"> nature is awsome </span>
        <img src="images/example2.jpg" alt="">
        <div class="inter">
            <div><i class="fa-solid fa-thumbs-up"></i> Like</div>
            <div><i class="fa-solid fa-comment"></i> Comment</div>
            <div><i class="fa-solid fa-share"></i> Share</div>
        </div>
    </div>
</div>

<div id="dms">
    <h1> Messages: </h1>
    <div class="dm-bar">    
        <div class="contact" online> </div>
        <div class="contact"> </div>
        <div class="contact"> </div>
        <div class="contact selected" online></div>
        <div class="contact" online> </div>
        <div class="contact"> </div>
        <div class="contact"> </div>
        <div class="contact"> </div>
        <div class="contact" online> </div>
    </div>
    <span>first last <i style="color: #0b0;">(online)</i></span>
    <div class="mess">
        <div class="cont">
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, qui nihil! Suscipit at placeat harum quisquam eius recusandae, inventore eaque ducimus hic dolor mollitia tempora eveniet accusantium ratione magnam aut.</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, qui nihil! Suscipit at placeat harum quisquam eius recusandae, inventore eaque ducimus hic dolor mollitia tempora eveniet accusantium ratione magnam aut.</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo modi totam beatae commodi fuga reiciendis excepturi laborum magni impedit officia?</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, qui nihil! Suscipit at placeat harum quisquam eius recusandae, inventore eaque ducimus hic dolor mollitia tempora eveniet accusantium ratione magnam aut.</div>
        </div>
        <div class="text" contenteditable placeholder="Message..."></div>
        <i class="fa-solid fa-share-from-square"></i>
    </div>
</div>
</section>
</body>
</html>