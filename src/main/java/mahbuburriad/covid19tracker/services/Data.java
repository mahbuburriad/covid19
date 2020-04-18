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

    //location stats
    private List<LocationStats> stats = new ArrayList<>();

    public List<LocationStats> getStats() {
        return stats;
    }

    //for recovered stats
    private List<LocationStats> rStats = new ArrayList<>();

    public List<LocationStats> getrStats(){
        return rStats;
    }

    //after get data then execute
    @PostConstruct
    //start a cron job to run this method every second
    @Scheduled(cron = "* * 1 * * *")
    public void fetchData() throws IOException, InterruptedException {
        List<LocationStats> newStats = new ArrayList<>();
        List<LocationStats> newRStats = new ArrayList<>();
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

        HttpClient recoveredClient = HttpClient.newHttpClient();
        HttpRequest recoveredRequest = HttpRequest.newBuilder()
                .uri(URI.create(recovered_Data_URL))
                .build();
        HttpResponse<String> recoveredHttpResponse = recoveredClient.send(recoveredRequest, HttpResponse.BodyHandlers.ofString());
        System.out.println(recoveredHttpResponse.body());

        StringReader csvBodyReaderR = new StringReader(recoveredHttpResponse.body());
        Iterable<CSVRecord> recordsRs = CSVFormat.DEFAULT.withFirstRecordAsHeader().parse(csvBodyReaderR);

        //get data from Data table.
        for (CSVRecord record : records) {
            LocationStats locationStats = new LocationStats();
            locationStats.setState(record.get("Province/State"));
            locationStats.setCountry(record.get("Country/Region"));
            locationStats.setLat(record.get("Lat"));
            locationStats.setLon(record.get("Long"));
            int latestCases = Integer.parseInt(record.get(record.size() - 1));
            int prevCases = Integer.parseInt(record.get(record.size() - 2));
            locationStats.setLatestTotalCases(latestCases);
            locationStats.setDiffFromPrevDay(latestCases-prevCases);
            System.out.println(locationStats);
            newStats.add(locationStats);
        }
        this.stats = newStats;

        for (CSVRecord recordr : recordsRs){
            LocationStats recoveredStats = new LocationStats();
            int lastedRecoveredCases = Integer.parseInt(recordr.get(recordr.size() - 1));
            recoveredStats.setLatestRecoveredCases(lastedRecoveredCases);
            int diffFromPrevRecovered = Integer.parseInt(recordr.get(recordr.size() - 2));
            recoveredStats.setDiffFromPrevRecovered(lastedRecoveredCases-diffFromPrevRecovered);
            System.out.println(recoveredStats);
            newRStats.add(recoveredStats);
        }
        this.rStats = newRStats;
    }
}
