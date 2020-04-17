package mahbuburriad.covid19tracker;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.scheduling.annotation.EnableScheduling;

@SpringBootApplication
//enable the scheduling for cron job
@EnableScheduling
public class Covid19TrackerApplication {

	public static void main(String[] args) {
		SpringApplication.run(Covid19TrackerApplication.class, args);
	}

}
