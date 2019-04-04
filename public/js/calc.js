
$("document").ready(function () {
"use strict";
var attempt = 0;
var n1,n2,tim2;
var notify;
$('#calc').on('click',function(){
   $('#calc-container').slideToggle() 
})


// $(window).on("unload", function(e) {
//     $('#testfinishh').click();
//    });

// $(window).bind('beforeunload', function(){
//     return ' want to leave??';
// });


function generatenoti(){
    notify = new Notification('STAY ON THE TEST PAGE ATTEMPT NO('+ ++attempt +' of 3)', {
        body: 'THIS IS THE WARNING MESSAGE!!!"',
    });
    console.log('notificaton generated');
}


$(window).blur(function(){
    if(attempt < 3 ){
        var d = new Date();
        var n = d.getTime();
        n1=n/1000;
        n2=n1;
        tim2 = setInterval(function () {
            n2++;
            if((n2-n1) == 2){
                generatenoti();
            }
        }, 1000);

    }
    else{
        $(window).off("beforeunload");
        $('#testfinish').click();        
    }
  });
  
  $(window).focus(function(){
    clearInterval(tim2);
    if (n1+20 <= n2++) {
    alert('20 seconds up test over');
    $(window).off("beforeunload");
    $('#testfinish').click();
    }
    });

$('body').on('click',function(event){
    if (!$(event.target).closest('#calc-container').length) {
        if($('#calc-container').css("display") != 'none'){
            $('#calc-container').slideUp();
        }
      }
    
})

$('#calc').on('click', function (event) {
    event.stopPropagation();
  });


$(".bi").on("click", function (elem) {
parseInput(elem.currentTarget.innerHTML);
$("#display").text(arr.join(" "));
});
$(".un").on("click", function (elem) {
parseInput(elem.currentTarget.innerHTML);
parseInput("(");
$("#display").text(arr.join(" "));
});
$(".clear").on("click", function () {
arr = ["0"];
$("#display").text(arr.join(" "));
});
$(".ans").on("click", function () {
if (hist)  {
console.log(hist);
hist.forEach(function(elem) {
  arr.push(elem);
});
}
$("#display").text(arr.join(" "));
});
$(".equals").on("click", function (elem) {
parseInput(elem.currentTarget.innerHTML);
result = compRP(arr.join(" "));
arr = result;
hist = result.map(function(a) {return a.toString();});
console.log("answerFromEquals",hist);
$("#display").text(result.join(" "));
});
});

var arr = ["0"];
var parsedNegs = [];
var operators = "()^?*+-/%E";
var hist;

function parseInput(a) {
if (a === "=") {
arr.forEach(function(elem,i) {
elem = elem.toString();
console.log("elem",elem);
if (elem.length !== 1 && elem.slice(0,1) === "-") {
    Array.prototype.push.apply(parsedNegs, ["(",-1,"*",parseFloat(elem.slice(1)),")"]);
} else if (isNaN(elem)) {
    parsedNegs.push(elem);
} else {
    parsedNegs.push(parseFloat(elem));
}
});
arr = parsedNegs;
parsedNegs = [];
return;
} //  close  '='


if (a === "del") {
if (!isNaN(arr[arr.length-1]) && arr[arr.length-1].length>1) {
arr[arr.length-1] = arr[arr.length-1].slice(0,arr[arr.length-1].length-1);
} else if (arr.length == 1) {
arr = ["0"];
} else {
arr.pop();
}
return;
}

if (arr.length && arr[arr.length-1] === "-" && (arr.length === 1 || (operators.indexOf(arr[arr.length-2])) !== -1 && arr[arr.length-2] !== ")")) {
arr[arr.length-1]+=a.toString();
} else if (arr.length == 1 && arr[0] === "0") {
arr = [a];
} else if (!arr.length || operators.indexOf(arr[arr.length-1]) !== -1) {
arr.push(a.toString());
} else if (operators.indexOf(a) !== -1) {
arr[arr.length-1] = arr[arr.length-1];
arr.push(a);
} else {
arr[arr.length-1]+=a.toString();
}
}

var result;
var resultAsArray;
var decPoint;
var decShift;

var pre = {
"tan": 5,
"sin": 5,
"cos": 5,
"log": 5,
"ln": 5,
"sqrt": 5,
"E": 5,
"^": 4,
"%": 3,
"*": 3,
"/": 3,
"+": 2,
"-": 2,
"(": 1,
"=": 0
};

var constants = {
"pi": Math.PI,
"e": Math.E
};

var unary = {
"sin": function(a) {return Math.sin(a);},
"cos": function(a) {return Math.cos(a);},
"tan": function(a) {return Math.tan(a);},
"log10": function(a) {return Math.log10(a);},
"log": function(a) {return Math.log(a);},
"sqrt": function(a) {return Math.sqrt(a);}
};

var binary = {
"E": function(a,b) {return a * Math.pow(10,b);},
"^": function(a,b) {return Math.pow(a,b);},
"%": function(a,b) {return a%b;},
"*": function(a,b) {return a*b;},
"/": function(a,b) {return a/b;},
"+": function(a,b) {return a+b;},
"-": function(a,b) {return a-b;}
};



function in2RP(str) {
"use strict";
var inArr = str.split(" ");

var stack = [];
var RP = [];
var curr;

while (inArr.length) {

curr = inArr.shift();

curr = constants.hasOwnProperty(curr) ? constants[curr] : curr;
console.log('curr',curr,'\n');
console.log('stack',stack,'\n');

if (!isNaN(curr)) {
RP.push(curr);
} else if (!stack.length || (pre[curr] > pre[stack[stack.length - 1]]) || curr === "(") {
stack.push(curr);
} else if (curr === ")") {
while (stack[stack.length - 1] !== "(") {
    RP.push(stack.pop());
}
stack.pop();
} else {
while (pre[curr] <= pre[stack[stack.length - 1]]) {
    RP.push(stack.pop());
}
stack.push(curr);
}
}

while (stack.length) {
RP.push(stack.pop());
}

return RP.join(' ');
}

function compRP(str) {
"use strict";
var input = in2RP(str).split(' ');
console.log('RP',input);
var stack = [];
var curr,a,b;
while (input.length) {
curr = input.shift();
console.log("computeCurr",curr);
console.log("computeStack",stack);
if (!isNaN(curr)) {
stack.push(parseFloat(curr));
} else if (unary.hasOwnProperty(curr)) {
a = stack.pop();
stack.push(unary[curr](a));
} else if (binary.hasOwnProperty(curr)) {
b = stack.pop();
a = stack.pop();
stack.push(binary[curr](a,b));
} else {
console.log("Cannot parse token",curr);
}
}
if (stack.length > 1) {
return "Too many values on stack" + stack.toString();
} else {
result = stack[0];

if (result>1000000 || result<-1000000) {
decShift = 0;

while (result>=10 || result<=-10) {
    result/=10;
    decShift+=1;
}

return [result,"E",decShift];

} else if (result<0.00001 && result>-0.00001 && result !== 0) {
decShift = 0;
while (result<1 && result>-1) {
    result*=10;
    decShift-=1;
}
return [result,"E",decShift];
} else {
return [result];
}

}
            
}

