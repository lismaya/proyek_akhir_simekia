package com.example.sipanji.ui.riwayat;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class RiwayatImunisasiModelList {

    @SerializedName("riwayatImunisasiList")
    private ArrayList<RiwayatImunisasiModelRecycler> riwayatImunisasiList;

    public ArrayList<RiwayatImunisasiModelRecycler> getRiwayatImunisasiArrayList() {
        return riwayatImunisasiList;
    }

    public void setArraylList(ArrayList<RiwayatImunisasiModelRecycler> riwayatImunisasiArrayList) {
        this.riwayatImunisasiList = riwayatImunisasiArrayList;
    }

}
