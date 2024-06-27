

function handlerequestfriend(event ,sender,receiver, callback)
{
  
  const element = event.currentTarget
  const url = 'endpoints/FriendRequest.php'
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest()

   // Prepare the request
    var data = {
                    sender,receiver
                }
    xhr.open('POST', url, true)
    
    xhr.setRequestHeader('Content-type', 'application/json')
    
    // Send the request
    xhr.send(JSON.stringify(data));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Request was successful, handle the response here
            callback(element,sender,receiver)
            console.log(xhr.response)
           } else {
            // There was an error, handle it here
            console.error('Request failed. Status:', xhr.status);
          }
        }
      };

}



function profileFriendRequested(element,sender,receiver,callback)
{
  element.setAttribute("data-done","")
  element.innerHTML = '<i class="fa-solid fa-user-minus"></i> Remove request'
  element.removeAttribute("onclick")
  element.setAttribute("onclick",`handleremoverequest(event,${sender},${receiver})`) 
  const notifData = {actor: myName, 	image:myImage, 	seen:false, 	target:receiver, 	 	type:'friend', 	typeId:sender, }
  callback({...notifData,number:1})
}


function handleremoverequest(event ,sender,receiver)
{
  
  const element = event.currentTarget
  const url = 'endpoints/FriendRequest.php'

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest()

   // Prepare the request
    var data = {
                    sender,receiver
                }
    xhr.open('DELETE', url, true)
    
    xhr.setRequestHeader('Content-type', 'application/json')
    
    // Send the request
    xhr.send(JSON.stringify(data));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Request was successful, handle the response here
            element.removeAttribute("data-done")
            element.innerHTML = '<i class="fa-solid fa-user-plus"></i> Add friend'
            element.removeAttribute("onclick")
            element.setAttribute("onclick",`handlerequestfriend(event,${sender},${receiver},(element,sender,receiver)=>{interact(profileFriendRequested,[element,sender,receiver] )})`) 
            console.log(xhr.response)
           } else {
            // There was an error, handle it here
            console.error('Request failed. Status:', xhr.status);
          }
        }
      };

}




function handleacceptfriend(event ,sender,receiver)
{
  
  const element = event.currentTarget
  const url = 'endpoints/Friend.php'
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest()

   // Prepare the request
    var data = {
                    f1:sender,f2:receiver
                }
    xhr.open('POST', url, true)
    
    xhr.setRequestHeader('Content-type', 'application/json')
    
    // Send the request
    xhr.send(JSON.stringify(data));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Request was successful, handle the response here
            element.setAttribute("data-done","")
            element.innerHTML = '<i class="fa-solid fa-user-minus"></i> Remove friend'
            element.removeAttribute("onclick")
            element.setAttribute("onclick",`handleremoverequest(event,${sender},${receiver})`) 
            console.log(xhr.response)
           } else {
            // There was an error, handle it here
            console.error('Request failed. Status:', xhr.status);
          }
        }
      };

}



function handleremovefriend(event ,sender,receiver)
{
  const element = event?.currentTarget
  const url = 'endpoints/Friend.php'
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest()

   // Prepare the request
    var data = {
                    f1:sender,f2:receiver
                }
    xhr.open('DELETE', url, true)
    
    xhr.setRequestHeader('Content-type', 'application/json')
    
    // Send the request
    xhr.send(JSON.stringify(data));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Request was successful, handle the response here
            if(element){
              element.removeAttribute("data-done")
              element.innerHTML = '<i class="fa-solid fa-user-plus"></i> Add friend'
              element.removeAttribute("onclick")
              element.setAttribute("onclick",`handlerequestfriend(event,${sender},${receiver},(element,sender,receiver)=>{interact(profileFriendRequested,[element,sender,receiver] )})`) 
            }else
              location.reload();
            
            console.log(xhr.response)
           } else {
            // There was an error, handle it here
            console.error('Request failed. Status:', xhr.status);
          }
        }
      };

}