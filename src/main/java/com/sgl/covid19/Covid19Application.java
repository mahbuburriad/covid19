package com.sgl.covid19;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.builder.SpringApplicationBuilder;
import org.springframework.scheduling.annotation.EnableScheduling;
import org.springframework.boot.web.servlet.support.SpringBootServletInitializer;

@SpringBootApplication
//enable the scheduling for cron job
@EnableScheduling
public class Covid19Application extends SpringBootServletInitializer{

	public static void main(String[] args) {
		SpringApplication.run(Covid19Application.class, args);
	}

	//to support spring framework with tomcat
	@Override
	protected SpringApplicationBuilder configure(SpringApplicationBuilder application) {
		return application.sources(Covid19Application.class);
	}

}
