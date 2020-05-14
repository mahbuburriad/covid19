package com.sgl.covid19.controllers;

import com.sgl.covid19.models.BangladeshStats;
import com.sgl.covid19.services.Bangladesh_Data;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;

import java.util.List;

public class mapController {
    @GetMapping("/map")
    public String map(){
        return "map";
    }
}
