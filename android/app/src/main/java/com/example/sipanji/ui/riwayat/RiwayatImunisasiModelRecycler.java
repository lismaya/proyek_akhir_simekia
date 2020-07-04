package com.example.sipanji.ui.riwayat;

import com.google.gson.annotations.SerializedName;

public class RiwayatImunisasiModelRecycler {

    @SerializedName("id")
    private int id;
    @SerializedName("tgl")
    private String tgl;
    @SerializedName("jenis")
    private String jenis;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTgl() {
        return tgl;
    }

    public void setTgl(String tgl) {
        this.tgl = tgl;
    }

    public String getJenis() {
        return jenis;
    }

    public void setJenis(String jenis) {
        this.jenis = jenis;
    }
}
