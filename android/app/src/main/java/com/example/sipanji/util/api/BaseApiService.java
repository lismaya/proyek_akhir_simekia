package com.example.sipanji.util.api;

import android.app.DownloadManager;

import com.example.sipanji.ui.home.AnakModelList;
import com.example.sipanji.ui.riwayat.RiwayatImunisasiModelList;
import com.example.sipanji.ui.riwayat.RiwayatPemeriksaanModelList;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface BaseApiService {
    @FormUrlEncoded
    @POST("login")
    Call<ResponseBody> login(@Field("username") String username,
                             @Field("password") String password);

    @GET("get-anak")
    Call<AnakModelList> getAnak(@Query("ortu_id") int ortu_id);

    @GET("get-riwayat-imunisasi")
    Call<RiwayatImunisasiModelList> getRiwayatImunisasi(@Query("pasien_id") int pasien_id);

    @GET("get-riwayat-pemeriksaan")
    Call<RiwayatPemeriksaanModelList> getRiwayatPemeriksaan(@Query("pasien_id") int pasien_id);
}
