import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-app.js";
import { getFirestore, collection, onSnapshot, query, where,or, addDoc,updateDoc } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-firestore.js";

var unsubscribe = ()=>{}

const display = document.querySelector(".mess .cont")

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyBoMlCQy7Ugjo1HCbf6Z6iyQWsNCa0m_oM",
    authDomain: "verbind-8055b.firebaseapp.com",   
    projectId: "verbind-8055b",    
    storageBucket: "verbind-8055b.appspot.com",    
    messagingSenderId: "775845934827",   
    appId: "1:775845934827:web:f9cd205cd1e72e143e30ae"    
    };

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Initialize Firestore
const db = getFirestore(app);

// Reference to your collection
const colRef = collection(db, 'messages');

const querry = query(colRef, or(where('sender', '==', me),
                                where('receiver', '==', me)))


const subscribe = ()=>{
    
                                
    return onSnapshot(querry, (snapshot) => {
        snapshot.docChanges().sort((a,b)=>a.doc.data().time-b.doc.data().time).forEach(async (change) => {
        if (change.type === "added") {
            const data = change.doc.data()
            if(data.receiver == them)
                addMess(data.message,data.time,"sent")
            else if(data.sender == them){
                addMess(data.message,data.time,"rec")
                if(!data.seen)
                    await updateDoc(change.doc.ref, {
                    seen: true
                    });
            }
            updateContacts(data.sender==me ? data.receiver: data.sender ,data.seen || data.sender == me)
        }
        });
    });
}

unsubscribe = subscribe()


const addMess = (content,time,type) =>
{

    var newMess = document.createElement('div');
    newMess.className = type
    newMess.setAttribute("data-time", time)
    
    newMess.textContent = content;

    display.insertBefore(newMess,display.firstChild);

}



const sendMess = async (content) => {
    try {
        
      const time = Date.now()
      await addDoc(collection(db, "messages"), {
        sender: me,
        receiver: them,
        message: content,
        time
      });
  
    } catch (error) {
      console.error("Error sending message:", error.message);
    }
  };
  



const messageForm = document.querySelector(".message-form")

messageForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const formData = new FormData(messageForm);
    const message = formData.get('message');
    if(message.length)
        sendMess(message)
    messageForm.querySelector(".text").value = ""
});



const ids = [];
const updateContacts  = (contact,seen = false) =>
{
    const convs = document.querySelector("#convs")
    if(convs){
        
        if(ids.indexOf(contact) == -1)
        {
            ids.push(contact)
            getUserDate(contact,(data)=>{
                var newConv = document.createElement('div');
                
                newConv.className = `person cont-${contact}`

                newConv.addEventListener("click",()=>{ loadConversation(data,contact) })

                if(data.image)
                    newConv.innerHTML += `<img src="${data.image}" alt="">`;
                else
                    newConv.innerHTML += `<img src="images/Account.webp" alt="">`;
                newConv.innerHTML += `<span> ${data.firstname} ${data.lastname}</span>`;
                convs.appendChild(newConv);
                if(them === contact)
                    loadConversation(data,contact)
            })    
        }

        if(!seen){
            const corresponding = Array.from(convs.children).find(a=>a.classList.contains(`cont-${contact}`));
            corresponding?.classList.add("new");
        }
        
        
    }
}




function getUserDate(id,callback)
{
  
 
    const url = `endpoints/user.php?id=${id}`;
    
    var xhr = new XMLHttpRequest()

    xhr.open('GET', url, true)
    
    xhr.send();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Request was successful, handle the response here
            callback(JSON.parse(xhr.response)[0])
           } else {
            // There was an error, handle it here
            console.error('Request failed. Status:', xhr.status);
          }
        }
      };

}


function loadConversation(data,id)
{
    unsubscribe()
    const element = display.parentElement;
    const contact = element.parentElement.querySelector(".person")
    contact.innerHTML = `<a href = "profile.php?id=${id}">  
                            <img src="${data.image  || 'images/Account.webp'}" alt="">
                            <span> ${data.firstname} ${data.lastname} </span>
                            </a>`;
    display.innerHTML = "";
    messageExit.style.display = "block";
    element.querySelectorAll("input").forEach(e=> e.removeAttribute("disabled"));
    them = id
    saveConvInSession(id)
    subscribe()
}

function saveConvInSession(id)
{
 
    const url = `endpoints/user.php`;
    
    var xhr = new XMLHttpRequest()

    xhr.open('POST', url, true)
    
    xhr.send(JSON.stringify({id}));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status !== 200) {
            console.error('error loading conversation:', xhr.status);
          }
        }
      };

}


const messageExit = document.querySelector(".unload")

messageExit.addEventListener('click', (event) => {
    const element = display.parentElement;
    element.parentElement.querySelector(".person").innerHTML = ""
    display.innerHTML = "";
    messageExit.style.display = "none";
    element.querySelectorAll("input").forEach(e=> e.setAttribute("disabled",true));
    them = null
    saveConvInSession(null)
});



export {updateContacts, loadConversation};