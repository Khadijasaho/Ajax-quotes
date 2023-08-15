<html>
  <head>
    <title>AJAX Quotes</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Tulpen+One&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');   
      
      /* CSS to hide the quote container initially and apply fade-in animation */
        #quoteContainer {
            display: none;
          font-size:xx-large;           
          text-shadow: 4px 4px 4px #aaa;
        }

        /* CSS for the fade-in animation */
        .fade-in {
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

    </style>
  </head>
  <body>
    <h1>AJAX Quotes</h1>
  <p>Click below to return a random quote</p>
  
  <div id="quoteContainer">Quotes go here</div>
    <h2>About Page</h2>
    <p>We creates a page that retrieves random quotes from a PHP server side page using AJAX.  In the process of the assignment, we start by building a page that retrieves the quote on click and then later, we also build a version that retrieves a quote on page load, and then at intervals every few seconds.</p>
  <script>
    

    //helps us loop the array of fonts
    var counter = 0;
    function getRandomQuote(){

      var fonts = ["Shadows Into Light","Tulpen One","Qwitcher Grypen"];
      //alert("It works!");
      //create ajax object
      var xhr = new XMLHttpRequest();

      //target the server page
      xhr.open('GET', 'random_quotes.php',true);
      //if data comes back, show it here
      xhr.onload = function(){
        if(xhr.status >= 200 && xhr.status < 300){//all ok, show data
          //document.querySelector("#quoteContainer").innerText = xhr.responseText;
          var quoteContainer = document.querySelector("#quoteContainer");

          //retrieve text from php page
          quoteContainer.innerText = xhr.responseText;

          //add font family
          quoteContainer.style.fontFamily = fonts[counter];
          counter++;
          if(counter >= fonts.length){
            counter = 0;
          }
          //make element visible
          quoteContainer.style.display = "block";

          //add fade in class
          quoteContainer.classList.add("fade-in");
          

          setTimeout(function(){
            quoteContainer.classList.remove("fade-in");
          },1000);          
        }else{//show error
          document.querySelector("#quoteContainer").innerText = "Failed to fetch quote." + xhr.status;
        }
      };
      
      //if trouble. investigate here
      xhr.onerror = function(){
        alert("OH OH! WE RECEIVED AN XHR ERROR!");
      };
      

      //send data to server
      xhr.send();
    }

    function displayRandomQuote(){
      //retrieve quote
      getRandomQuote();

      //run every 5 seconds
      setInterval(getRandomQuote,5000);
        
    }
    //run on page load
    displayRandomQuote();
    
  </script> 
  </body>
</html>
