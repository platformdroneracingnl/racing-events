function Language(lang) {
    // Verander taal afkorting indien niet 2 letters
    if (lang == "nl-NL") {
        lang = "nl";
    } else if (lang == "nl") {
        lang = "nl"
    } else {
        lang = "en";
    }

    var __construct = function() {
        if (eval('typeof ' + lang) == 'undefined') {
            lang = "en";
        } return;
    } ()

    this.getStr = function(str, defaultStr) {
        var retStr = eval('eval(lang).' + str);
        if (typeof retStr != 'undefined') {
            return retStr;
        } else {
            if (typeof defaultStr != 'undefined'){
                return defaultStr;
            } else {
                return eval('en.' + str);
            }
        }
    }
}

var en = {
    deleteAccount: "After confirmation, your account will be deleted, along with all your registrations",
    deleteEvent: "After confirmation, the relevant competition will be deleted plus all associated registrations",
    deleteLocation: "After confirmation, the relevant location will be deleted",
    registerEvent: "After confirmation, your registration will be announced to the organizer",
    deleteOrganization: "After confirmation, the organization concerned will be removed from the system",
    deleteRaceTeam: "After confirmation, the race team concerned will be removed from the system",
    deleteRole: "After confirmation, the relevant role will be removed from the system",
    deletePilot: "After confirmation, the pilot will be removed from the race",
    deleteUser: "After confirmation, the user will be removed from the system",
    areYouSure: "Are you sure?",
    yesConfirm: "Yes!",
    noCancel: "No, cancel",
};

var nl = {
    deleteAccount: "Na bevestiging wordt je account verwijderd, daarbij ook al je inschrijvingen",
    deleteEvent: "Na bevestiging zal de betreffende wedstrijd verwijderd worden plus alle gekoppelde inschrijvingen",
    deleteLocation: "Na bevestiging zal de betreffende locatie verwijderd worden",
    registerEvent: "Na bevestiging zal je inschrijving bij de organisator bekend worden gemaakt",
    deleteOrganization: "Na bevestiging zal de betreffende organisatie verwijderd worden uit het systeem",
    deleteRaceTeam: "Na bevestiging zal het betreffende race team verwijderd worden uit het systeem",
    deleteRole: "Na bevestiging zal de betreffende rol verwijderd worden uit het systeem",
    deletePilot: "Na bevestiging zal de piloot worden verwijderd van de wedstrijd",
    deleteUser: "Na bevestiging zal het betreffende account verwijderd worden uit het systeem",
    areYouSure: "Weet je het zeker?",
    yesConfirm: "Jazeker!",
    noCancel: "Nee, annuleer",
};