<?php 
    $currentPage = 'messages';
?>




<!DOCTYPE html>
<html lang="en" spellcheck="false">
    <?php  
    require "templates/header.php"; 
    require "templates/nav.php"
    ?>
<section id="content">    
    <div id="contacts" onclick="document.getElementById('messages').style.display = 'block'" >
        <h1>Contacts:</h1>
        <div class="person" online>
            <div>
            <img src="images/Account.png" alt="">
            <span>first last</span>
            </div>
        </div>
        <div class="person"online>
            <div>
            <img src="images/Account.png" alt="">
            <span>first last</span>
            </div>
        </div>
        <div class="person">
            <div>
            <img src="images/Account.png" alt="">
            <span>first last</span>
            </div>
        </div>
        <div class="person">
            <div>
            <img src="images/Account.png" alt="">
            <span>first last</span>
            </div>
        </div>
        <div class="person"online>
            <div>
            <img src="images/Account.png" alt="">
            <span>first last</span>
            </div>
        </div>
    </div>  
<div id="messages">
    <div class="person" online>
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
    </div>
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