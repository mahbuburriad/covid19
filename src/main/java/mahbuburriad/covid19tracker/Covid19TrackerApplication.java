package mahbuburriad.covid19tracker;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.builder.SpringApplicationBuilder;
import org.springframework.boot.web.servlet.support.SpringBootServletInitializer;
import org.springframework.scheduling.annotation.EnableScheduling;

@SpringBootApplication
//enable the scheduling for cron job
@EnableScheduling
public class Covid19TrackerApplication extends SpringBootServletInitializer {
	@Override
	protected SpringApplicationBuilder configure(SpringApplicationBuilder application) {
		return application.sources(Covid19TrackerApplication.class);
	}

	public static void main(String[] args) {
		SpringApplication.run(Covid19TrackerApplication.class, args);
	}
}