package com.example.sipanji.ui.home;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class AnakModelList {

    @SerializedName("anakList")
    private ArrayList<AnakModelRecycler> anakList;

    public ArrayList<AnakModelRecycler> getAnakArrayList() {
        return anakList;
    }

    public void setAnakArraylList(ArrayList<AnakModelRecycler> anakArrayList) {
        this.anakList = anakArrayList;
    }

}
