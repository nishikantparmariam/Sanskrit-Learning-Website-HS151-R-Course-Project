 // Initialize Firebase
 var config = {
    apiKey: "AIzaSyDLetBUGErfGVTJs-uz6247mI_pkWhBRvw",
    authDomain: "easysanskrit-e8f45.firebaseapp.com",
    databaseURL: "https://easysanskrit-e8f45.firebaseio.com",
    projectId: "easysanskrit-e8f45",
    storageBucket: "easysanskrit-e8f45.appspot.com",
    messagingSenderId: "111427767611"
  };
  firebase.initializeApp(config);
  
  firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
  
    if (file_code==="a") {  
    window.location="home/"; //will pass our actual home domain after hosting  
    }
  } else {
    if (file_code==="b")
    { 
    window.location="../"; //will pass our actual domain after hosting    
    }
  }
 
});

function userSignOut() {
    firebase.auth().signOut().then(function() {
       
      window.location="../"; //will pass our actual domain after hosting    
      }).catch(function(error) {
          window.alert('Error')
      });
    }