package com.example.sipanji.ui.riwayat;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class RiwayatPemeriksaanModelList {

    @SerializedName("riwayatPemeriksaanList")
    private ArrayList<RiwayatPemeriksaanModelRecycler> riwayatPemeriksaanList;

    public ArrayList<RiwayatPemeriksaanModelRecycler> getRiwayatPemeriksaanArrayList() {
        return riwayatPemeriksaanList;
    }

    public void setArraylList(ArrayList<RiwayatPemeriksaanModelRecycler> riwayatPemeriksaanArrayList) {
        this.riwayatPemeriksaanList = riwayatPemeriksaanArrayList;
    }

}
