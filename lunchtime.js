var time = setInterval(time, 1);
var dinnerTime = setInterval(dinnerTime, 1);
var startime = new Date().getTime;

function dhm(ms){
    const days = Math.floor(ms / (24*60*60*1000));
    const daysms = ms % (24*60*60*1000);
    const hours = Math.floor(daysms / (60*60*1000));
    const hoursms = ms % (60*60*1000);
    const minutes = Math.floor(hoursms / (60*1000));
    const minutesms = ms % (60*1000);
    const sec = Math.floor(minutesms / 1000);
    const pad = function(n){ return n < 10 ? '0' + n : n; };
    return [pad(days), pad(hours), pad(minutes), pad(sec)].join(' : ');
}

function time() {
    const newTime=new Date();
    const checkHour=new Date().getHours();
    if(checkHour<7)
    {
        if(checkHour<24)
        {
            const year=newTime.getFullYear();
            var month=newTime.getMonth();
            month=month+1;
            var day=newTime.getDate();
            const pad = function(n){ return n < 10 ? '0' + n : n; };
            month=pad(month);
            day=pad(day);
            var countdown=year+"-"+month+"-"+day+"T07:00:00+06:00";
            const next1=new Date(countdown);
            const next=new Date(countdown).getTime();
            const time=next-newTime;
            const get=dhm(time);
            document.getElementById("time").innerHTML = get;
            document.getElementById("date").innerHTML = next1.toLocaleString('default', {weekday: 'long', month: 'long', day: '2-digit', year: 'numeric' });
        }
    }
    else
    {
        if(checkHour<24)
        {
            const year=newTime.getFullYear();
            var month=newTime.getMonth();
            month=month+1;
            var day=newTime.getDate();
            const pad = function(n){ return n < 10 ? '0' + n : n; };
            month=pad(month);
            day=pad(day);
            var countdown=year+"-"+month+"-"+day+"T07:00:00+06:00";
            const next=new Date(new Date(countdown).getTime() + 24 * 60 * 60 * 1000);
            const next1=new Date(next);
            const time=next-newTime;
            const get=dhm(time);
            document.getElementById("time").innerHTML = get;
            document.getElementById("date").innerHTML = next1.toLocaleString('default', {weekday: 'long', month: 'long', day: '2-digit', year: 'numeric' });
        }
    }
}


function dinnerTime() {
    const newTime=new Date();
    const checkHour=new Date().getHours();
    if(checkHour<16)
    {
        if(checkHour<24)
        {
            const year=newTime.getFullYear();
            var month=newTime.getMonth();
            month=month+1;
            var day=newTime.getDate();
            const pad = function(n){ return n < 10 ? '0' + n : n; };
            month=pad(month);
            day=pad(day);
            var countdown=year+"-"+month+"-"+day+"T16:00:00+06:00";
            const next1=new Date(countdown);
            const next=new Date(countdown).getTime();
            const time=next-newTime;
            const get=dhm(time);
            document.getElementById("dinnerTime").innerHTML = get;
            document.getElementById("date2").innerHTML = next1.toLocaleString('default', {weekday: 'long', month: 'long', day: '2-digit', year: 'numeric' });

        }
    }
    else
    {
        if(checkHour<24)
        {
            const year=newTime.getFullYear();
            var month=newTime.getMonth();
            month=month+1;
            var day=newTime.getDate();
            const pad = function(n){ return n < 10 ? '0' + n : n; };
            month=pad(month);
            day=pad(day);
            var countdown=year+"-"+month+"-"+day+"T16:00:00+06:00";
            const next=new Date(new Date(countdown).getTime() + 24 * 60 * 60 * 1000);
            const next1=new Date(next);
            const time=next-newTime;
            const get=dhm(time);
            document.getElementById("dinnerTime").innerHTML = get;
            document.getElementById("date2").innerHTML = next1.toLocaleString('default', {weekday: 'long', month: 'long', day: '2-digit', year: 'numeric' });
        }
    }
}