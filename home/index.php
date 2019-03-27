<?php $file_code="hm";?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Easy Sanskrit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://www.gstatic.com/firebasejs/5.4.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.6/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.4.0/firebase-database.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        var file_code = "b"
    </script>    
    <script src="../data/firebase_js.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../data/homestyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script>
            var user_everywhere;
            var points_ev;
            firebase.auth().onAuthStateChanged(function(user){
                if (user) 
                {
                    user_everywhere = user;
                    firebase.database().ref('/user_info/' + user.uid).on('value', function(snapshot) {
                    var name = snapshot.child('name').val();
                    var points = snapshot.child('points').val();
                    if (name==null) 
                    {
                        document.getElementById('askFordisplayName').style.cssText="display:block !important;";
                    }
                    if (name.length>=25) {
                        var name = name.substring(0, 25)+"..";
                    }
                    if (points==null) 
                    {
                        firebase.database().ref('user_info/'+user.uid).update({points:0});
                        points_ev = 0;
                    } else {
                    points_ev = points; }
                    document.getElementById('dpnameshow').innerHTML='<i class="fa fa-user"></i>&nbsp;&nbsp;'+name+'<div style="float:right;"><i class="fa fa-star"></i> '+points.toString()+'</div>';
                    });
                   
                   
                    
                }
            });
            
            function loadchp(cn) 
                    {

                        document.getElementById('learncinner').innerHTML="<div id='ldi'><br><center><img style='width:100px;' src='../data/img/loader.gif'/><br>Loading, please wait...</center></div>";
                        var cnr = ''+cn;
                        var cnn= cn+1;
                        firebase.database().ref('/chapters/chapter'+cnr).on('value', function(snapshot) {
                            $('#ldi').remove();
                            $('#learncinner').empty();
                            var titleoc = snapshot.child('title').val();
                            var  theDiv = document.getElementById('learncinner');
                            snapshot.forEach(function(child){
                                if (child.key!="title") {
                                var inDiv = document.createElement('div');
                                inDiv.innerHTML=child.val();
                                inDiv.classList.add('blocksincpt');
                                //var node = document.createTextNode(child.key);
                                theDiv.appendChild(inDiv);    
                                //theDiv.removeChild(document.getElementById('ldi'));
                                }
                            });
                            $('#ldi').remove();
                            if (titleoc==null) {
                                        window.alert("Chapters have ended.");
                                        loadchp(cn-1);
                            } else {
                            document.getElementById('nextbtnlearn').innerHTML="<button id='nextbtnl' onclick='loadchp("+cnn+")'> Next&nbsp;&raquo; </button>";
                            document.getElementById('chphead').innerHTML="Chapter #<b>"+cnr+"</b><br>"+titleoc;
                           
                            }
                        });
                        
                        if (cn>1) 
                        {
                            var cnp = cn - 1;
                             document.getElementById('prevbtnlearn').innerHTML=" <button id='nextbtnl' onclick='loadchp("+cnp+");'>&laquo;&nbsp;Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
                        }
                        if (cn==1) 
                        {
                            document.getElementById('prevbtnlearn').innerHTML=""; 
                        }
                    
                    };
            function setUserInfo() 
            {
                    firebase.auth().onAuthStateChanged(function(user) {
                    if (user) 
                    {
                        var displayname=document.getElementById('displaynameask').value;
                        //var userage=document.getElementById('ageask').value;
                        if (displayname!="")
                        {

                            firebase.database().ref('user_info/'+user.uid).update({name:displayname});
                            document.getElementById('askFordisplayName').style.cssText="display:none !important;";
                        }
                        else 
                        {
                           document.getElementById('err_show').innerHTML="<div style='color:red;'>Please write name.</div>";
                        }
                    }
                    else 
                    {
                        
                    }
                }
            );
            }

        function showsdnvb() 
        {
            document.getElementById('all_except_side_nav').style.cssText="margin-left:90vw !important;"
            document.getElementById('sidnavb').style.cssText="margin-left:0px !important;width:90vw;"
            document.getElementById('sidnavcloset').style.cssText="display:block !important;"
            
           
        }
        function closdnvb() 
        {
            document.getElementById('all_except_side_nav').style.cssText="margin-left:0px !important;"
            document.getElementById('sidnavb').style.cssText="margin-left:-100vw !important;width:100vw;"
            document.getElementById('sidnavcloset').style.cssText="display:none !important;"
        }
        function openlistdp(vv)
        {
            if (vv.classList.contains("random"))
            {
                document.getElementById('dpnlist').style.cssText="display:none !important;";
                vv.classList.remove("random");
            }
            else {
                    document.getElementById('dpnlist').style.cssText="display:block !important;"
                    vv.classList.add("random");
            }
            
        };

        $(document).ready(function() {
            loadchp(1);
            $('#takequizc').hide();
            $('#leaderboardc').hide();
            $('#askquec').hide();
            $('#learnc').hide();
            $('#learnc').fadeIn(300);
            $('#leadersload').html("<div id='ldi'><br><center><img style='width:100px;' src='../data/img/loader.gif'/><br>Loading, please wait...</center></div>");
            $('#quizinin').html("<div id=''><br><center><img style='width:100px;' src='../data/img/loader.gif'/><br>Loading, please wait...</center></div>");
        });
        function clickedlinnb(v) 
        {
            v.classList.add('clickednb');
            $('.linsnb').not(v).each(function(){
                $(this).removeClass('clickednb');
             });

        }

        function changedpna() 
        {
            document.getElementById('askFordisplayName').style.cssText="display:block !important;";
        }
        function loadinc(x)  
        {
            $('#takequizc').hide();
            $('#leaderboardc').hide();
            $('#askquec').hide();
            $('#learnc').hide();
            $('#'+x+'').fadeIn(300);
            var sw = window.innerWidth;
            //window.alert(sw);
            if (sw<900) {
            document.getElementById('all_except_side_nav').style.cssText="margin-left:0px !important;"
            document.getElementById('sidnavb').style.cssText="margin-left:-100vw !important;width:100vw;"
            document.getElementById('sidnavcloset').style.cssText="display:none !important;"
            
            }

        }

        firebase.database().ref('/user_info/').on('value', function(snapshot) {
            const pninfo = new Array();
            snapshot.forEach(function(child){
                var lbname = child.child('name').val();
                var lbpoints = child.child('points').val();
                if (lbpoints==null) 
                {
                    var lbpoints = 0;
                }
                var pn = new Array(lbpoints, lbname);
                pninfo.push(pn);
                
            })
            
            pninfo.sort((function(index){
                return function(a, b){
                    return (a[index] === b[index] ? 0 : (a[index] > b[index] ? -1 : 1));
                };
            })(0));
            var theDivlb = document.getElementById('leadersload');
            //window.alert(theDivlb);
            $('#leadersload').empty();
            
            var i;
            for (i = 0; i < pninfo.length; i++) {
                var lbapoints = pninfo[i][0];
                var lbaname = pninfo[i][1];
                var inDivlb = document.createElement('div');
                inDivlb.innerHTML="<div id='name_in_lb'>"+lbaname+"</div><div id='points_in_lb'>"+lbapoints+"</div>";
                inDivlb.classList.add('divinlb');
                theDivlb.appendChild(inDivlb);   
            }     
            });
            var quansinfo = new Array();
            function lqb() {
            firebase.database().ref('/quiz/').on('value', function(snapshot) {
                document.getElementById('quizinin').innerHTML=' ';
                if ($('#quizinin').empty()) {
                snapshot.forEach(function(child) {
                    var qtitle = " ";//child.child('quiztitle').val();
                    var eachquearray = [qtitle];
                    child.forEach(function(ichild){
                        if (ichild.key!=="quiztitle") {
                           
                        var ans = ichild.child('ans').val();
                        var op1 = ichild.child('o1').val();
                        var op2 = ichild.child('o2').val();
                        var op3 = ichild.child('o3').val();
                        var que = ichild.child('question').val();
                        //eachquearray.push();
                        eachquearray.push([que,ans,op1,op2,op3]);
                        }
                    });
                    quansinfo.push(eachquearray);     
                });
                
                document.getElementById('quizinin').innerHTML=" ";
                doquizprocessing(quansinfo);  }  
            });
            }
            lqb();
            var bigarraygbl;

            function doquizprocessing(bigarray) {
                document.getElementById('quizinin').innerHTML=" ";
                bigarraygbl = bigarray;
                var theDivlb = document.getElementById('quizinin');
                
                i=0
                var points_ar = new Array();
                firebase.database().ref('/user_info/'+user_everywhere.uid+'/quizzes').on('value', function(snapshot) {
                        var j=1
                        while (j <= bigarray.length) 
                        {
                            points_ar.push(snapshot.child('quiz'+j).val());
                               j++; 
                        }

                        
                });
                
                var inDivlb = document.createElement('div');
                inDivlb.innerHTML="<div id='name_in_lb'>Quizzes&nbsp;<b style='font-size:10pt;font-weight:normal !important;'>(Click to start)</b></div><div id='points_in_lb'>Status</div>";
                inDivlb.classList.add('divinlbqs');
                theDivlb.appendChild(inDivlb); 
                for (x in bigarray) 
                {
                    if (points_ar[i]==null) 
                    {
                        points_ar[i]="<b style='color:green;'>New</b>";
                    }
                    else 
                    {
                        points_ar[i]="Max score: <i class='fa fa-star'></i> "+points_ar[i];
                    }
                    var quizno = i+1;
                    var inDivlb = document.createElement('div');
                    inDivlb.setAttribute('onclick','startquiz('+i+')');
                    inDivlb.innerHTML="<div id='name_in_lb'>( Quiz : "+quizno+" )&nbsp;"+bigarray[i][0]+"</div><div id='points_in_lb'>"+points_ar[i]+"</div>";
                    inDivlb.classList.add('divinlbq');
                    theDivlb.appendChild(inDivlb);  
                    i++;
                }  
                var inDivlb = document.createElement('div');
                inDivlb.innerHTML="<br>";
                theDivlb.appendChild(inDivlb);  
            }
            var noppq = 1; 
            function checkans(qi,noofque,ansar,mine,sece) 
                {
                    
                    var x=1;
                    var answers = new Array();
                    while (x<=noofque) 
                    {
                        var xs="ddd";
                        var rs = document.getElementsByName("q"+x);
                            for (var j = 0; j < rs.length; j++) {
                                if (rs[j].checked) {
                                    answers.push(rs[j].value);
                                    var xs="dd";
                                }
                                else 
                                {

                                }
                            }
                            if (xs=="ddd")
                            {
                                answers.push(null);
                            }
                        x++
                    }
                    var ww = new Array();    
                    var j= 0;
                    while (j<ansar.length) 
                    {
                        if (ansar[j]==answers[j]) 
                        {
                            ww.push(1);
                        }
                        else if (answers[j]==null) 
                        {
                            ww.push(0);
                        }
                        else 
                        {
                            ww.push(-1);
                        }
                        j++;
                    }
                    var k=0;
                    var ra=0;
                    var wa=0;
                    var na=0;
                    for (z in ww) 
                    {
                        if (ww[k]==0) 
                        {
                            na++;
                        }    
                        else if(ww[k]==-1) 
                        {
                            wa++;
                        }
                        else 
                        {
                             ra++   
                        }
                        k++   
                    }    

                    var score = Math.floor(ra*noppq);
                    document.getElementById('wqdiv').innerHTML="<b>Score:</b> <i class='fa fa-star'></i> "+score.toString()+" Points<br><br> <div style='color:green;'>Correct : "+ra.toString()+"</div><br><div style='color:red;'>Wrong : "+wa.toString()+"</div><br>Not Attempted :"+na.toString()+"<br><button onclick='addscore("+qi+","+score+")'  id='regbtn' style='padding:5px 10px;'>Done</button><div><br><div style='font-size:12px;'>(The current score will be added to your <b>points</b> only if it is more than maximum score you have achieved for this quiz.)</div>";
                    
                 }

            function addscore(qno,score) 
            {
                
                
                firebase.database().ref('/user_info/'+user_everywhere.uid+'/quizzes').on('value', function(snapshot) {
                        qno = qno.toString()
                        score_before=snapshot.child('quiz'+qno).val();
                        if (score_before>=score) 
                        {

                        } else
                        {
                            var incs = score-score_before;
                            var newp = points_ev+incs;
                            firebase.database().ref('user_info/'+user_everywhere.uid).update({points:newp});
                            var q="quiz"+qno.toString();
                            firebase.database().ref('user_info/'+user_everywhere.uid+'/quizzes/').update({[q]:score});
                            
                        }
                        
                        location.reload();
                        //$('#wqdiv').empty();
                        //document.getElementById('runQuiz').style.cssText="display:none;"
                        $('#quizinin').empty();
                        
                        
                });
               

            }


            



            function startquiz(quizindex) 
            {
                
                function preventBack(){window.history.forward();}
                setTimeout("preventBack()", 0);
                window.onunload=function(){null};
                $('#wqdiv').empty();
                document.getElementById('runQuiz').style.cssText="display:block;";
                document.getElementById('wqdiv').style.cssText="display:block;";    
                var ourQuiz = bigarraygbl[quizindex];
                var titleofourQuiz = ourQuiz[0];  
                document.getElementById('wqdiv').innerHTML="";
                var ntpq=7;
                var i=1 ;
                var ql=ourQuiz.length-1;
                var qt = document.createElement('div');
                qt.innerHTML="<div style='position:fixed;background-color:#fff;border-radius:5px;padding:10px;box-shadow:0px 0px 1px #000;float:right !important;;'><div style='float:right !important;color:red;'>Time left &nbsp;&nbsp;<div style='float:right;' id='showqt'></div></div></div><br><br><br>";
                document.getElementById('wqdiv').appendChild(qt);
                var qt = document.createElement('div');
                qt.innerHTML="Quiz :"+(quizindex+1)+" "+titleofourQuiz+"";
                document.getElementById('wqdiv').appendChild(qt);
                var ansar = new Array();
                var min = 0;
                var sec = 0;
                function stq(x) 
                {
                    if (x<0) 
                    {
                        var x=ntpq*(i-1) ;
                        min = Math.floor(x/60);
                        sec = x-(min*60);
                        if (min.toString().length==1) 
                        {
                            var min = "0"+min.toString();
                        }
                        if (sec.toString().length==1) 
                        {
                            var sec = "0"+sec.toString();
                        }
                        checkans(quizindex+1,i-1,[ansar],min.toString(),sec.toString());
                    }
                    else
                    {
                        min = Math.floor(x/60);
                        sec = x-(min*60);
                        if (min.toString().length==1) 
                        {
                            var min = "0"+min.toString();
                        }
                        if (sec.toString().length==1) 
                        {
                            var sec = "0"+sec.toString();
                        }
                        document.getElementById('showqt').innerHTML=min.toString()+":"+sec.toString(); 
                        setTimeout(function() {
                                stq(x-1)
                        }, 1000);
                    }
                } 
                

                while (i<=ql) {
                                    ansar.push("\""+ourQuiz[i][1].toString()+"\"");
                                    var oneQuet = document.createElement('div');
                                    oneQuet.innerHTML="<b>Q"+i+".</b> "+ourQuiz[i][0];
                                    var op1 = document.createElement('div');
                                    op1.innerHTML="<input type='radio' name='q"+i+"' value='1'> "+ourQuiz[i][2];
                                    var op2 = document.createElement('div');
                                    op2.innerHTML="<input type='radio' name='q"+i+"' value='2'> " +ourQuiz[i][3];
                                    var op3 = document.createElement('div');
                                    op3.innerHTML="<input type='radio' name='q"+i+"' value='3'> "+ourQuiz[i][4];
                                    op1.classList.add('opiq');
                                    op2.classList.add('opiq');
                                    op3.classList.add('opiq');
                                    document.getElementById('wqdiv').appendChild(oneQuet);
                                    document.getElementById('wqdiv').appendChild(op1);
                                    document.getElementById('wqdiv').appendChild(op2); 
                                    document.getElementById('wqdiv').appendChild(op3);
                                    var br = document.createElement('div');
                                    br.innerHTML="<div style='border-top:1px solid #aaa;margin-top:5px;margin-bottom:5px;'>&nbsp;</div>";                                    
                                    document.getElementById('wqdiv').appendChild(br);
                                    i++
                }  
              
                stq(ntpq*(i-1));
                var qt = document.createElement('div');
                qt.innerHTML="<input type='submit' id='regbtn' style='padding:5px 10px;' value='Submit &raquo;' onclick='checkans("+(quizindex+1)+","+(i-1)+",["+ansar+"],"+min+","+sec+")'></form>";
                document.getElementById('wqdiv').appendChild(qt);
                /*setTimeout(function() {
                document.getElementById('wqdiv').innerHTML=" ";   
                $('#runQuiz').fadeOut('fast');
            }, 5000); */  
                
            }
            //$(window).bind('beforeunload', window.alert('Why?'));
        </script>
    <style>
        .opiq 
        {
            margin-top:5px;
        }
        #wqdiv 
        {
            width:100%;
            overflow-y:scroll !important;   
            max-height:76vh; 
        }
        #wqdivo 
        {
            width:100%;
            max-height:80vh !important;
            margin-left:20%;
            width:60%;
            border-radius:5px;
            background-color:#fff;
            margin-bottom:10vh !important;
            margin-top:10vh !important; 
        } 
        #runQuiz  {
            display: none;
            position: fixed;
            z-index: 9999;
            padding-bottom: 100px; 
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.8);
            width: 100%; 
            height: 100%;
            overflow: auto;
            left: 0;
            top: 0;
            
        }
        .divinlbqs 
        {
            padding:15px 3%;
            background-color:#fff;
            border-bottom:1px solid #bbb;
            height:22px;
            color:#999;
        }
        .divinlbq 
        {
            padding:15px 3%;
            background-color:#fff;
            border-bottom:1px solid #bbb;
            height:22px;
            color:#232323;
        }
        .divinlbq:hover
        {
            background-color:#f5f5f5;
            cursor:pointer;
        }
        .divinlbq:hover > points_in_lb 
        {
            color:#fff;
        }
        .divinlb 
        {
            padding:10px 3%;
            background-color:#fff;
            border-bottom:1px solid #bbb;
            height:18px;
            
            color:#333;
        }
        #points_in_lb 
        {
            float:right;
            
        }
        #name_in_lb 
        {
            float:left;
        }
        #displaynameask, #ageask
        {
            width:90% !important;
            margin-top:15px;
            border-radius:5px;
            border:1px solid #aaaaaa;
            padding:10px 5%;
            font-size:11pt;
            display:block;
        }
        .blocksincpt 
        {
            text-align:left !important;
            margin-bottom:10px;
        }
        body 
        {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            padding:0;
            background-color:#e9ebee;
            overflow-x:hidden;
            font-size:11pt;
        }
        #askFordisplayName  {
            display: none;
            position: fixed;
            z-index: 999;
            padding-top: 100px; 
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.8);
            width: 100%; 
            height: 100%;
            overflow: auto;
            left: 0;
            top: 0;
            
        }
        .clickednb 
        {
            color:#fff !important;
            background-color:#000;
        }
        #bmd 
        {
            width:100%;
            background-color:#e9ebee;
            border-top:1px solid rgba(0,0,0,0.3);
            text-align:center;
            padding-top:20px;
            padding-bottom:20px;
        }
        #askFordisplayNameinside 
        {
            background-color:#ffffff;
            border-radius:5px;
            box-shadow:0px 1px 2px rgba(0,0,0,0.5);
            z-index:2 !important;
            position:fixed;
            width:30%;
            margin-left:35%;
            margin-top:0px;
            display:;
        }
        @media screen and (max-width:900px) {
            #askFordisplayNameinside 
            {
                width:85%;
                margin-left:7.5%;
                margin-right:7.5%;
            }
            #topNav 
            {
                width:100% !important; 
                margin-left:0px !important;
                margin-right:0px !important;
            }
            #all_except_side_nav 
            {
                margin-left:0% !important;
                margin-right:0% !important;
                width:100% !important;
                transition:0.2s;
            } 
            #sidnavb 
            {
                margin-left:-100% !important;
                width:100%;
                transition:0.2s;
            }  
            #bmd 
            {
                border-radius:5px 5px 0px 0px;
            
            }  
            #sidnavbtoggle 
            {
                display:block !important;
                position:fixed;
                margin-left:3%;
                margin-top:10px;
                background-color:#222;
                color:#aaa;
                border-radius:6px;
                padding:8px 15px;   
                cursor:pointer; 
            }
            #sidnavbtoggle:hover 
            {
                color:#fff;
            }
            #lbcin , #qin
            {
                width:94% !important;
                margin-left:3% !important;
            }
            #wqdivo 
            {
                width:94% !important;
                margin-left:3% !important;
            }
    }
            #regbtn
        {
        
            margin-top:15px;
            border-radius:5px;
            border:1px solid #1f5e79;
            padding:5px 5%;
            display:block;
            background-color:#4baad3;
            color:#ffffff;
            transition: 0.2s; 
        }
        #nextbtnl 
        {
            
            border-radius:5px;
            border:1px solid #1f5e79;
            padding:5px 10px;
            font-size:11pt;
            display:block;
            background-color:#4baad3;
            color:#ffffff;
            transition: 0.2s; 
        }
        #regbtn:hover
        {
            background-color: #FFFFFF;
            color:#1f5e79;
        }
        
        #sidnavb 
        {
            background-color:#222;
            width:20%;
            position:fixed;
            border-right:1px solid rgba(0,0,0,0.4);
            box-shadow:0px 0px 0px rgba(0,0,0,0.6);
            height:100% !important;
            transition:0.2s;
            z-index:99;

        }
        #all_except_side_nav 
        {
            margin-left:20%;
            transition:0.2s;    
            margin-right:0%;
        }
        #logodiv 
        {
            width:86%;
            font-size:17pt;
            padding:18px 7%;
            color:#fff;
            font-family: 'Cuprum', sans-serif;
            border-bottom:1px solid #000;
        }
        #sidnavbtoggle 
        {
            display:none;
            font-size:13pt;
            z-index:99;

        }
        #sidnavcloset 
        {
            float:right;
            color:#aaa;
            cursor:pointer;
            display:none;
        }
        #sidnavcloset:hover, #sidnavcloset:focus 
        {
            color:#fff;
        }
        #linsnb 
        {
            width:86%;
            color:#aaa;
            padding:15px 7%;
            border-bottom:1px solid #000;
            font-family: 'Cuprum', sans-serif;
            font-size:14pt;
            cursor:pointer;
            transition:0.2s;
        }
        #linsnb:hover 
        {
            color:#fff;
            background-color:#000;
        }
        #linsnb i 
        {
            font-size:15pt;
            
        }
        #dpnlist 
        {
            display:none;
            transition:0.5s;
        }
        #topNav 
        {
            height:78px;
            position:fixed;
            z-index:2;
            border-bottom:1px solid rgba(0,0,0,0.1);
            background-color:#039be5;
            width:80%;
        }
        #lbcin 
        {
            min-height:250px;width:50%;margin-left:25%;background-color:#fff;box-shadow:0px 0px 2px rgba(0,0,0,0.3);border-radius:5px;border:1px solid #ccc;
        }
        #qin 
        {
            min-height:250px;width:70%;margin-left:15%;border-radius:4px;border:1px solid #ccc;background-color:#fff;box-shadow:0px 0px 0px rgba(0,0,0,0.3);
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">
</head>
<body >
    <div id="sidnavbtoggle" onclick="showsdnvb()">
        <i class='fa fa-bars'></i>
    </div>
    <div id="sidnavb">
        
        <div id="logodiv" style='border-bottom:1px solid #4baad3;'>
            Easy SANSKRIT <div id="sidnavcloset"  onclick="closdnvb()"><i class="fa fa-close"></i></div>
            <br><div style="font-family:Arial;font-size:10pt;color:#aaaaaa;">&nbsp;&nbsp;&nbsp;We made it easy.</div>
        </div>
        <div id="linsnb" class="linsnb"  onclick="openlistdp(this);clickedlinnb(this);" class="dpnlist_s">
            <div id="dpnameshow">Loading...</div>
        </div>
        <div id="dpnlist">
            <div id="linsnb" class="linsnb" style="border-top:1px solid #4baad3 !important;" onclick="userSignOut(this);">
                Logout
            </div>
            <div id="linsnb" class="linsnb"   onclick="clickedlinnb(this);changedpna();">
                Change Name
            </div> 
            <div id="linsnb" class="linsnb"  style="border-bottom:1px solid #4baad3 !important;" onclick="clickedlinnb(this);javascript:window.location='../team';">
                Help | Contact Us
            </div>  
        </div>
        <div id="linsnb" class="linsnb clickednb"  onclick="clickedlinnb(this);loadinc('learnc');">
            <i class="fa fa-book"></i>&nbsp;&nbsp;LEARN
        </div>
        <div id="linsnb" class="linsnb"  onclick="clickedlinnb(this);loadinc('takequizc');">
            <i class="fa fa-question"></i>&nbsp;&nbsp;TAKE QUIZ
        </div>
        <div id="linsnb" class="linsnb" onclick="clickedlinnb(this);loadinc('leaderboardc');">
            <i class="fa fa-star"></i>&nbsp;&nbsp;LEADER BOARD
        </div>
        <!--div id="linsnb" class="linsnb" onclick="clickedlinnb(this);loadinc('askquec');">
            <i class="fa fa-question-circle"></i>&nbsp;&nbsp;ASK QUESTION
        </div-->
    </div>
    <div id="all_except_side_nav">
        <!--div style="" id="topNav">
            
        </div-->
        
        <div class="content_main">
            <div id="learnc">
                <br><br><br><br>
                <div  style="min-height:520px;width:100%;padding-bottom:15px;margin-left:0%;background-color:#fff;box-shadow:0px 0px 2px rgba(0,0,0,0.3);">
                    <div style="width:94%;margin-left:3%;;margin-right:3%;">
                        <div style="padding-top:20px !important;width:100%;height:65px;">
                            <div id="chphead" style="margin-top:;font-size:17pt;float:left;font-family: 'Cuprum', sans-serif;"></div> 
                            <div id="nextbtnlearn" style="float:right;">
                                <button id='nextbtnl' onclick='loadchp(2);'> Next&nbsp;&raquo; </button>
                            </div>
                            <div id="prevbtnlearn" style="float:right;">
                            </div>
                        </div>
                            
                        <div id="learncinner" style="text-align:center;width:100%;background-color:#fff;">
                                
                        </div>  

                    </div> 
                </div>
            </div>
            <div id="takequizc">
                 <br><br><br><br>
                 <div  style="" id="qin">
                        <div style="width:94%;padding:10px 3%;font-family:'Cuprum',sans-serif;font-size:15pt;">
                               QUIZ TIME (COMPETE AND LEARN)
                        </div>
                        <div id="quizinin" style="padding-top:10px;"></div>
                 </div>   
            </div>
            <div id="leaderboardc">
                <br><br><br><br>
                <div  id="lbcin" style="">
                    
                    <div style="width:94%;padding:10px 3%;background-color:#f5f5f5;border-bottom:1px solid #bbb;border-radius:5px 5px 0px 0px;font-family:'Cuprum',sans-serif;font-size:15pt;">
                        Live Leader Board <i class="fa fa-star"></i>
                    </div>
                    
                    <div id="leadersload" style="margin-top:15px;">
                    </div>
                </div>
            </div>
            <div id="askquec">
                <br><br><br><br>
                ASK QUE
            </div>
        </div>
        <br><br><br><br><br><br><br>
        <div id="bmd">
            <div  style="color:#444;">Developed By : <a id="est" STYLE=" color:#222;text-decoration:none;" href="../team/">Easy Sanskrit Team</a> | 2018</div> 
        </div>   
    </div>
    <div id="runQuiz">
        <div id="wqdivo">
            <div style="padding:2vh 2vh 2vh 2vh;">
                
                <div id="wqdiv"></div>
            </div>
        </div>
    </div>
    <div id="askFordisplayName">
        <div id="askFordisplayNameinside">
            <div style="margin:15px;z-index:99;">
                Set your full name please.
                <br>
                <input type="text" placeholder="Full Name" id="displaynameask" maxlength="50">
                <button id="regbtn" onclick="setUserInfo()">OK &raquo;</button>
                <div id="err_show" style="float:right;margin-top:-25px;"></div>
            </div>
        </div>
    </div>
</body>
</html>

