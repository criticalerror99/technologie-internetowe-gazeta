function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML =  h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);  
}

function checkTime(i) {
    if (i < 10) {i = "0" + i}; 
    return i;
  }

function readDate() {
    const now = new Date();
    let d = now.getDate();
    let m = now.getMonth()+1;
    let d_t = now.getDay();
    switch (d_t) {
        case 1:
            d_t = "poniedziałek";
            break;
        case 2:
            d_t = "wtorek";
            break;
        case 3:
            d_t = "środa";
            break;
        case 4:
            d_t = "czwartek";
            break;
        case 5:
            d_t = "piątek";
            break;
        case 6:
            d_t = "sobota";
            break;
        default:
            d_t = "niedziela";
            break;
    }
    switch (m) {
        case 1:
            m = "stycznia";
            break;
        case 2:
            m = "lutego";
            break;
        case 3:
            m = "marca";
            break;
        case 4:
            m = "kwietnia";
            break;
        case 5:
            m = "maja";
            break;
        case 6:
            m = "czerwca";
            break;
        case 7:
            m = "lipca";
            break;
        case 8:
            m = "sierpnia";
            break;
        case 9:
            m = "września";
            break;
        case 10:
            m = "października";
            break;
        case 11:
            m = "listopada";
            break;
        default:
            m = "grudnia";
            break;
    }
    if(d < 10) { d = "0" + d};
    if(m < 10) { m = "0" + m};
    const html = `
    Dziś jest ${d_t}, dnia ${d} ${m} ${now.getFullYear()} roku.`
    document.getElementById('data').innerHTML = html;
}