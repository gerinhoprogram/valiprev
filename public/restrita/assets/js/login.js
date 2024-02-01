window.onload = init();
function init(){
canvas = document.getElementById('canvas');
context = canvas.getContext('2d');
canvas.width = window.innerWidth ;
canvas.height = window.innerHeight;
canvas.addEventListener('mousemove',MouseMove,false);

mouse = {x:0,y:0}
particleHolder = [];
x = 100;
y = 100;
angle = 0.8;
radius = 40;
particleCount = 2000;
color = [
'rgba(106, 210, 231, 0.5)',
'rgba(250, 204, 0, 0.5)',
'rgba(63, 191, 202, 0.5)',
'rgba(78, 189, 233, 0.5)',
'rgba(37, 174, 228, 0.5)',
'rgba(0, 178, 255, 0.5)',
'rgba(0, 170, 255, 0.5)',
'rgba(255, 255, 0, 0.5)',
'rgba(255, 200, 0, 0.5)'
];


function MouseMove(event)
{
  mouse.x = event.pageX - canvas.offsetLeft;
  mouse.y = event.pageY - canvas.offsetLeft;
}
for(i = 0; i < particleCount ; i++)
{particleHolder.push(new generateParticles());}
function generateParticles()
{
this.x = Math.random()*canvas.width;
this.y = Math.random()*canvas.height;
this.color = color[Math.floor(Math.random()*color.length)];
this.rad = Math.floor(Math.random()*8);
}
function vibrate()
{

context.fillStyle = 'white';
context.fillRect(0, 0, canvas.width, canvas.height);
for(var j = 0; j < particleHolder.length; j++)
{
var p = particleHolder[j];
var distanceX = p.x - mouse.x;
var distanceY = p.y - mouse.y;
particleDistance =  Math.sqrt(distanceX*distanceX + distanceY*distanceY);

particleMouse = Math.max( Math.min( 75 / ( particleDistance /p.rad ), 10 ), 0.1 );
context.beginPath();
context.fillStyle = p.color;
context.arc(p.x + Math.sin(angle++*Math.cos(radius++)), 
p.y - Math.cos(angle++*Math.sin(radius++)), 
p.rad*particleMouse, Math.PI*2, false);
context.fill();
}
}
setInterval(vibrate, 30);
};