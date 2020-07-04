package com.example.sipanji.util.api;

public class UtilsApi {
    public static final String BASE_URL = "http://192.168.8.102/simekia/public/";
    public static final String BASE_URL_API = BASE_URL +  "api/";
    public static final String BASE_URL_WEBVIEW = BASE_URL + "webview/";

    // Mendeklarasikan Interface BaseApiService
    //@org.jetbrains.annotations.NotNull
    public static BaseApiService getAPIService(){
        return RetrofitClient.getClient(BASE_URL_API).create(BaseApiService.class);
    }
}
