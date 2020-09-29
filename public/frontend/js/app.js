// API BASE URL
const BASE_URL = "https://corona.lmao.ninja/";

/**
 *  Function for Fetch Data
 * @param url
 * @returns {Promise<any>}
 */
async function getData(url) {
    let response = await fetch(url);
    return await response.json();
}

const mapStatus = async function (selectorID) {
    const countriesData = await getData(BASE_URL + 'v2/countries');
    const map = selectorID.querySelector('#map-status');
    const mostCases = "#006491";
    const mediumCases = "#4A97B9";
    const minCases = "#ACCDDC";
    const mapColors = {};

    countriesData.map(async (country) => {
        if (country.countryInfo.iso2) {
            const countryCode = country.countryInfo.iso2.toLowerCase();
            if (country.cases >= 0 && country.cases <= 50000) {
                mapColors[countryCode] = minCases;
            } else if (country.cases > 50000 && country.cases <= 100000) {
                mapColors[countryCode] = mediumCases;
            } else if (country.cases > 100000) {
                mapColors[countryCode] = mostCases;
            }
        }
    })

    jQuery(map).vectorMap({
        map: 'world_en',
        backgroundColor: null,
        borderColor: '#fff',
        borderOpacity: 0.1,
        borderWidth: 1,
        enableZoom: false,
        hoverColor: null,
        hoverOpacity: null,
        normalizeFunction: 'linear',
        scaleColors: ['#b6d6ff', '#005ace'],
        selectedColor: null,
        selectedRegions: null,
        showTooltip: true,
        colors: mapColors,
        onLabelShow: async function (event, label, code) {
            const cdata = await getData(BASE_URL + `v2/countries/${code}`);
            const ddd = `${cdata.country}: ${cdata.cases}`;
            if (label.length) {
                label[0].innerText = ddd;
            } else {
                event.preventDefault();
            }
        },
    });
}
