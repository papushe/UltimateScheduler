
var USS  = (function () {

    'use strict';

    var week = [
        {
            name: "Sun",
            morning:"",
            evening: "",
            night: ""
        },
        {
            name: "Mon",
            morning:"",
            evening: "",
            night: ""
        },
        {
            name: "Tue",
            morning:"",
            evening: "",
            night: ""
        },
        {
            name: "Wed",
            morning:"",
            evening: "",
            night: ""
        },
        {
            name: "Thu",
            morning:"",
            evening: "",
            night: ""
        },
        {
            name: "Fri",
            morning:"",
            evening: "",
            night: ""
        },
        {
            name: "Sat",
            morning:"",
            evening: "",
            night: ""
        }];

    var users = [
        {
            first_name:"moshe",
            last_name: "cohen",
            email: "moshec@optimalplus.com"
        },
        {
            first_name:"tal",
            last_name: "kot",
            email: "talk@optimalplus.com"
        },
        {
            first_name:"lior",
            last_name: "haimov",
            email: "liorh@optimalplus.com"
        },
        {
            first_name:"hovav",
            last_name: "cohen",
            email: "hovavc@optimalplus.com"
        },
        {
            first_name:"itzik",
            last_name: "moalem",
            email: "itzikm@optimalplus.com"
        },
        {
            first_name:"shlomi",
            last_name: "lougassi",
            email: "shlomil@optimalplus.com"
        },
        {
            first_name:"namma",
            last_name: "lapidot",
            email: "nammal@optimalplus.com"
        }];

    var executeScheduler = function () {
        for(var i = 0, j = 6; i < 7, j > -1;i++, j--){
            week[i].morning = users[i].first_name;
            console.log(week[i].morning);
            week[i].night = users[i].first_name;
            console.log(week[i].evening);
            week[j].evening = users[i].first_name;
            console.log(week[i].night);
        }
        return {
            executeScheduler: executeScheduler()
        };
    }
})();

USS.executeScheduler;