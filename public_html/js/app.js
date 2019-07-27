 
 
 
 
/*---------------------------------FACEBOOK------------------------------------*/
    window.fbAsyncInit = function() {
        // FB JavaScript SDK configuration and setup
        FB.init({
          appId      : '899019800301493', // FB App ID
          cookie     : true,  // enable cookies to allow the server to access the session
          xfbml      : true,  // parse social plugins on this page
          version    : 'v3.2' // use graph api version 3.2
        });

        // Check whether the user already logged in
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                getFbUserData();
            }else{
                window.open("index.html?t=" + Math.random(),"_self");
            }
        });
    };
    
        // Load the JavaScript SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
    
        // Facebook login with JavaScript SDK
    function fbLogin() {
        FB.login(function (response) {
            if (response.authResponse) {
                // Get and display the user profile data
                getFbUserData();
            } else {
                // document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
            }
        }, {scope: 'email'});
    }
    
    
// Logout from facebook
    function fbLogout() {
        FB.logout(function() {
            //launch index page/screen
            window.open("index.html?t=" + Math.random(),"_self");
        });
    }
    











/* ----------------------- SIDE-NAV----------------------------*/

// populates the Side nav with list of modules in the student's module list
function populateSideNavModule(userData){
        
        
                
        var data = { 
            userID: userData.id
        };
        
        
         $.getJSON('php/json-data-userModules.php',data, function(result) {
             
                $.each(result.userModules, function(index, module) { 
                        $('#sidenav_module_list').append('<a class="nav-link" style="font-size: 12px" href="module_details.html?module_id='+ module.moduleNo + '">' +'<i class="fa fa-circle-thin" aria-hidden="true"></i>'+module.moduleName+'</a>');
                });
         });
        
        
    }    




    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    // fade in the overlay
    $('.overlay').addClass('active');

}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            // hide overlay
            $('.overlay').removeClass('active');
}
    
    
    
    
    $(document).ready(function () {
 

        $('.overlay').on('click', function () {
            // hide sidebar
            document.getElementById("mySidenav").style.width = "0";
            // hide overlay
            $('.overlay').removeClass('active');

        });
    });
    
    
 
 
 
 
    
    
    /**--------------------------- TIMETABLE----------------------------------------- ***/
    
    
     function setLectureTimetable(userData){ 
        
        var data = {
            userID: userData.id
        };
        
        
         $.getJSON('php/json-data-timetable.php',data, function(result) { 
                
                $.each(result.lectureTimetable, function(index, module) {
                        populateTimetable(module.day,module);
                });
         });
    }
    
    
     function populateTimetableForToday(_day,module){
        var today = new Date().getDay(); // get today's day where Sunday=0,Monday=1 etc
        
        if(_day==today){
            $("#empty_today").remove();
            
           $('#pills-today').append('<div class="card mb-3 mx-auto" style="max-width: 40rem;">'+
                '<div class="card-header">'+ module.moduleName + '</div>'+
                '<div class="card-body text-secondary">'+
                  '<h5 class="card-title">'+ module.start_at + ' - '+ module.end_at + ' </h5>'+
                  '<p class="card-title">'+module.location+':'+' Room '+module.room+'</p>'+
                '</div>'+
              '</div>'
            );  
        }   
    }
    
    
    function populateTimetable(day,module){
        
        populateTimetableForToday(day,module);
        
        //if it is Sunday
        if (day==0){
            $("#empty_sun").remove();
            
            $('#pills-sun').append('<div class="card mb-3 mx-auto" style="max-width: 40rem;">'+
                '<div class="card-header">'+ module.moduleName + '</div>'+
                '<div class="card-body text-secondary">'+
                  '<h5 class="card-title">'+ module.start_at + ' - '+ module.end_at + ' </h5>'+
                  '<p class="card-title">'+module.location+':'+' Room '+module.room+'</p>'+
                '</div>'+
              '</div>'
            );  
        }
        // if it is Monday
        else if (day==1){
            $("#empty_mon").remove();
            
            $('#pills-mon').append('<div class="card mb-3 mx-auto" style="max-width: 40rem;">'+
                '<div class="card-header">'+ module.moduleName + '</div>'+
                '<div class="card-body text-secondary">'+
                  '<h5 class="card-title">'+ module.start_at + ' - '+ module.end_at + ' </h5>'+
                  '<p class="card-title">'+module.location+':'+' Room '+module.room+'</p>'+
                '</div>'+
              '</div>'
            );  
        }
        // if it is Tuesday
        else if (day==2){
            $("#empty_tue").remove();
            
            $('#pills-tue').append('<div class="card mb-3 mx-auto" style="max-width: 40rem;">'+
                '<div class="card-header">'+ module.moduleName + '</div>'+
                '<div class="card-body text-secondary">'+
                  '<h5 class="card-title">'+ module.start_at + ' - '+ module.end_at + ' </h5>'+
                  '<p class="card-title">'+module.location+':'+' Room '+module.room+'</p>'+
                '</div>'+
              '</div>'
            );  
        }
        // if it is Wednesday
        else if (day==3){
            $("#empty_wed").remove();
            
            $('#pills-wed').append('<div class="card mb-3 mx-auto" style="max-width: 40rem;">'+
                '<div class="card-header">'+ module.moduleName + '</div>'+
                '<div class="card-body text-secondary">'+
                  '<h5 class="card-title">'+ module.start_at + ' - '+ module.end_at + ' </h5>'+
                  '<p class="card-title">'+module.location+':'+' Room '+module.room+'</p>'+
                '</div>'+
              '</div>'
            );  
        }
        // if it is Thursday
        else if (day==4){
            $("#empty_thu").remove();
            
            $('#pills-thu').append('<div class="card mb-3 mx-auto" style="max-width: 40rem;">'+
                '<div class="card-header">'+ module.moduleName + '</div>'+
                '<div class="card-body text-secondary">'+
                  '<h5 class="card-title">'+ module.start_at + ' - '+ module.end_at + ' </h5>'+
                  '<p class="card-title">'+module.location+':'+' Room '+module.room+'</p>'+
                '</div>'+
              '</div>'
            );  
        }
        // if it is Friday
        else if (day==5){
            $("#empty_fri").remove();
            
            $('#pills-fri').append('<div class="card mb-3 mx-auto" style="max-width: 40rem;">'+
                '<div class="card-header">'+ module.moduleName + '</div>'+
                '<div class="card-body text-secondary">'+
                  '<h5 class="card-title">'+ module.start_at + ' - '+ module.end_at + ' </h5>'+
                  '<p class="card-title">'+module.location+':'+' Room '+module.room+'</p>'+
                '</div>'+
              '</div>'
            );  
        }
        // if it is Saturday
        else if (day==6){
            $("#empty_at").remove();
            
            $('#pills-sat').append('<div class="card mb-3 mx-auto" style="max-width: 40rem;">'+
                '<div class="card-header">'+ module.moduleName + '</div>'+
                '<div class="card-body text-secondary">'+
                  '<h5 class="card-title">'+ module.start_at + ' - '+ module.end_at + ' </h5>'+
                  '<p class="card-title">'+module.location+':'+' Room '+module.room+'</p>'+
                '</div>'+
              '</div>'
            );  
        }
        else {}
        
        
    }
    
    
    
    
    
    
 
    /*--------------------------------LIVE SEARCH--------------------------------*/
    $(document).ready(function(){
        $('.searchBox input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("php/live_search.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".searchBox").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });

    
    
    
    
    
    
    /**---------------------------MISCELANEOUS FUNCTIONS-------------------------**/
    
    /* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
      var currentScrollPos = window.pageYOffset;
      if (prevScrollpos > currentScrollPos) {
        document.getElementById("myNavbar").style.top = "0";
      } else {
        document.getElementById("myNavbar").style.top = "-70px";
      }
      prevScrollpos = currentScrollPos;
    }
    
    
    function dateDifference(dt2, dt1) {

      var diff =(dt2.getTime() - dt1.getTime()) / 1000;
      diff /= (60 * 60);
      return Math.abs(Math.round(diff/24));

     }
     
     
     function goBack() {
      window.history.back();
    }
    
    
      
   function goBack() {
      window.history.back();
    }
    
  
  function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
  }
  