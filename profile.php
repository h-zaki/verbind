<?php 
    $currentPage = 'profile';
    $me = true;
?>


<!DOCTYPE html>
<html lang="en" spellcheck="false">
<?php  
require "templates/header.php"; 
require "templates/nav.php"
?>

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
    
    <div class="profile">
       <div class="picture"> 
              <img src="images/Account.png" alt="">
              <span>first last</span>
        </div> 
            <span>111 <br> friends</span>
            <span>111 <br> posts</span>
    </div>
    <?php
    if ($me)
        echo    '<div class="make">
                <div id="textarea" contenteditable placeholder="write something..." spellcheck="false"></div>
            <div class="inter">
                <div><i class="fa-solid fa-camera"></i> Add image</div>
                <div><i class="fa-solid fa-share"></i> Share</div>
            </div>
            </div>';
    else 
        echo '<div class="inter">
                <div><i class="fa-solid fa-user-plus"></i> Add friend</div>
                <div><i class="fa-solid fa-message"></i> Send message</div>
             </div>';
    
    ?>
    <div class="f-element">
        <div class="person">
           <div></div>
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
           <div></div>
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
<?php require "templates/footer.php"  ?>
</html>