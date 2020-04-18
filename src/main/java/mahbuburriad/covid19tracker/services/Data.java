package mahbuburriad.covid19tracker.services;

import mahbuburriad.covid19tracker.models.LocationStats;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVRecord;
import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Service;

import javax.annotation.PostConstruct;
import java.io.IOException;
import java.io.StringReader;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.util.ArrayList;
import java.util.List;

//execute the service when get data
@Service
public class Data {
    //data confirm url
    //https://github.com/CSSEGISandData/COVID-19/blob/master/csse_covid_19_data/csse_covid_19_time_series/
    private static String Confirm_Data_URL = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_confirmed_global.csv";

    //recovered data url
    private static String recovered_Data_URL = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_recovered_global.csv";

    //death data url
    private static String death_Data_URL = "https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_deaths_global.csv";

    //Confirmed stats
    private List<LocationStats> stats = new ArrayList<>();

    public List<LocationStats> getStats() {
        return stats;
    }

    //for recovered stats
    private List<LocationStats> rStats = new ArrayList<>();

    public List<LocationStats> getrStats(){
        return rStats;
    }

    //for death stats
    private List<LocationStats> dStats = new ArrayList<>();
    public List<LocationStats> getdStats(){
        return dStats;
    }

    //after get data then execute
    @PostConstruct
    //start a cron job to run this method every second
    @Scheduled(cron = "* * * * * *")
    public void fetchData() throws IOException, InterruptedException {
        //array list for comfirmed stats
        List<LocationStats> newStats = new ArrayList<>();
        //array list for Recovered Stats
        List<LocationStats> newRStats = new ArrayList<>();
        //array list for death stats
        List<LocationStats> newDStats = new ArrayList<>();

        //create a client called httpclient to access HTTP
        HttpClient client = HttpClient.newHttpClient();
        //build pattern for HTTP
        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(Confirm_Data_URL)) //get the URI
                .build(); //set and build
        //send a request to client
        HttpResponse<String> httpResponse = client.send(request, HttpResponse.BodyHandlers.ofString());
        //print the body
        System.out.println(httpResponse.body());

        //parse a string for reader
        StringReader csvBodyReader = new StringReader(httpResponse.body());
        Iterable<CSVRecord> records = CSVFormat.DEFAULT.withFirstRecordAsHeader().parse(csvBodyReader);

        //for recovered stats
        HttpClient recoveredClient = HttpClient.newHttpClient();
        HttpRequest recoveredRequest = HttpRequest.newBuilder()
                .uri(URI.create(recovered_Data_URL))
                .build();
        //http response when get request data and build to ofstring method and send a request to client
        HttpResponse<String> recoveredHttpResponse = recoveredClient.send(recoveredRequest, HttpResponse.BodyHandlers.ofString());
        //print data to console
        System.out.println(recoveredHttpResponse.body());

        //format the CSV data from raw CSV
        StringReader csvBodyReaderR = new StringReader(recoveredHttpResponse.body());
        Iterable<CSVRecord> recordsRs = CSVFormat.DEFAULT.withFirstRecordAsHeader().parse(csvBodyReaderR);

        //for death stats
        HttpClient deathClient = HttpClient.newHttpClient();
        HttpRequest deathRequest = HttpRequest.newBuilder()
                .uri(URI.create(death_Data_URL))
                .build();
        //http response when get request data and build to ofstring method and send a request to client
        HttpResponse<String> deathHttpResponse = deathClient.send(deathRequest, HttpResponse.BodyHandlers.ofString());
        //print data to console
        System.out.println(deathHttpResponse.body());

        //format the CSV data from raw CSV
        StringReader csvBodyReaderD = new StringReader(deathHttpResponse.body());
        Iterable<CSVRecord> recordsDs = CSVFormat.DEFAULT.withFirstRecordAsHeader().parse(csvBodyReaderD);

        //get data from Data table for confirmed section
        for (CSVRecord record : records) {
            LocationStats locationStats = new LocationStats();
            locationStats.setState(record.get("Province/State"));
            locationStats.setCountry(record.get("Country/Region"));
            locationStats.setLat(record.get("Lat"));
            locationStats.setLon(record.get("Long"));
            int latestCases = Integer.parseInt(record.get(record.size() - 1)); //call last column
            int prevCases = Integer.parseInt(record.get(record.size() - 2)); //call second last column
            locationStats.setLatestTotalCases(latestCases);
            locationStats.setDiffFromPrevDay(latestCases-prevCases);
            System.out.println(locationStats); //print all value to console
            newStats.add(locationStats);
        }
        this.stats = newStats; //initialize the stats

        //fetch data for recovered section from data table
        for (CSVRecord recordr : recordsRs){
            LocationStats recoveredStats = new LocationStats();
            int lastedRecoveredCases = Integer.parseInt(recordr.get(recordr.size() - 1));  //call last column
            recoveredStats.setLatestRecoveredCases(lastedRecoveredCases);
            int diffFromPrevRecovered = Integer.parseInt(recordr.get(recordr.size() - 2)); //call second last column
            recoveredStats.setDiffFromPrevRecovered(lastedRecoveredCases-diffFromPrevRecovered);
            System.out.println(recoveredStats);
            newRStats.add(recoveredStats);
        }
        this.rStats = newRStats; //initialize the stats

        //fetch data for death section from data table
        for (CSVRecord recordd : recordsDs){
            LocationStats deathStats = new LocationStats();
            int lastestDeathCases = Integer.parseInt(recordd.get(recordd.size() - 1)); //call last column
            deathStats.setLastestDeathCases(lastestDeathCases);
            int diffFromPrevDeath = Integer.parseInt((recordd.get(recordd.size() - 2))); //call second last column
            deathStats.setDiffFromPrevDeath(lastestDeathCases - diffFromPrevDeath);
            System.out.println(deathStats);
            newDStats.add(deathStats);
        }
        this.dStats = newDStats; //initialize the stats
    }
}
