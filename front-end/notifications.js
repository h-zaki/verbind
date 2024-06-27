import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-app.js";
import { getFirestore, collection, onSnapshot, query, where,limit, addDoc,getDocs,updateDoc,doc } from "https://www.gstatic.com/firebasejs/9.22.1/firebase-firestore.js";



const display = document.querySelector(".notif-container")


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
const colRef = collection(db, 'notifications');

const q = query(colRef, where('target', '==', userid), where('number', '>', 0), limit(15));

var counter = 0

onSnapshot(q, (snapshot) => {
        snapshot.docChanges().sort((a,b)=>a.doc.data().time-b.doc.data().time).forEach(async (change) => {
            const data = change.doc.data()
            if (change.type === "added") {
                displayNotification(data,change.doc.id);
            }
            if (change.type === "modified" && !change.doc.data().seen) {
                const element = Array.from(display.children).find((a)=>a.id = `n-${change.doc.id}`)
                display.removeChild(element)
                displayNotification(data,change.doc.id);
            }
        });
    });



function displayNotification(data,id)
{

    var newNotif = document.createElement('div');
    newNotif.className = "notif-element"
    newNotif.id = `#n-${id}`

    var text,link = `profile.php?id=${userid}`;
    if(!data.seen)
    {
        updateCounter(1)
        newNotif.classList.add("unseen")
    }

    switch (data.type){
        case "like":
        {
            text = `${data.actor} ${data.number>1 ? ("and "+(data.number-1)+ " others"):""} liked your post`
            link += `&post=${data.typeId}`            //come back
            break
        }
        case "comment":
        {
            text = `${data.actor} ${data.number>1 ? ("and "+(data.number-1)+ " others"):""} commented on your post`
            link += `&post=${data.typeId}`            //come back
            break
        }
        case "share":
        {
            text = `${data.actor} ${data.number>1 ? ("and "+(data.number-1)+ " others"):""} shared your post`
            link += `&post=${data.typeId}`            //come back
            break
        }
        case "friend":
        {
            text = `${data.actor} sent you a friend request`
            link = `profile.php?id=${data.typeId}`            
            break
        }
        default:
        {
            text = `you have a notification from ${data.actor}`
            link = "#"
        }
    }

    newNotif.addEventListener("click",async ()=>{
        await seeNotification(id)
        window.location.href = link;
    })
    
    newNotif.innerHTML = `
                                <div>
                                <img src="${data.image || "images/Account.webp"}" alt="">
                                <span> ${text} </span>
                                <div>
                            `;

    display.insertBefore(newNotif,display.firstChild);

}


async function sendNotification(data)
{
    try {
        
        const time = Date.now()
        const q = query(colRef, where("target", "==", data.target), where("type", "==", data.type),where("typeId", "==", data.typeId));
        const querySnapshot = await getDocs(q);

        if (querySnapshot.empty) 
            await addDoc(colRef, {...data, time});
        else{
            const doc = querySnapshot.docs[0];
            await updateDoc(doc.ref, {
                number: doc.data().number+data.number,
                actor: data.actor,
                image: data.image,
                time : time,
                seen:false,
            });
        }
            
    
      } catch (error) {
        console.error("Error sending message:", error.message);
      }
}



function updateCounter(value)
{
    counter += value;
    if(counter > 0)
    {
        display.previousElementSibling.setAttribute("data-count",counter)
    }
}


async function seeNotification(id)
{
    const notif = doc(db, "notifications", id);

    
    await updateDoc(notif, {
        seen: true
    });
}

export {sendNotification}