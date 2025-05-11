const poyaAndMonthNames = {
            1 : {poyaName: "Duruthu",month: "Januray"},
            2 : {poyaName: "Nawam",month: "February"},
            3 : {poyaName: "Madin",month: "March"},
            4 : {poyaName: "Bak",month: "April"},
            5 : {poyaName: "Vesak",month: "May"},
            6 : {poyaName: "Poson",month: "June"},
            7 : {poyaName: "Asala",month: "July"},
            8 : {poyaName: "Nikini",month: "August"},
            9 : {poyaName: "Binara",month: "September"},
            10 : {poyaName: "Vap",month: "October"},
            11 : {poyaName: "Il",month: "November"},
            12 : {poyaName: "Uduvap",month: "December"},
}

const globalVariables = {
    poyaAndMonthNames : poyaAndMonthNames,
}

export default {
    install (app) {
        app.config.globalProperties.$globalVariables = globalVariables
    }
}; 