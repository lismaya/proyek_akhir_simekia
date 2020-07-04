package com.example.sipanji;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.ContextWrapper;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;


import com.example.sipanji.util.SharedPrefManager;
import com.example.sipanji.util.api.BaseApiService;
import com.example.sipanji.util.api.UtilsApi;

import org.jetbrains.annotations.NotNull;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.security.KeyManagementException;
import java.security.KeyStoreException;
import java.security.NoSuchAlgorithmException;
import java.security.cert.CertificateException;
import java.util.Objects;

import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;
import es.dmoral.toasty.Toasty;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity {
    @BindView(R.id.etUsername)
    EditText etUsername;
    @BindView(R.id.etPassword)
    EditText etPassword;
    @BindView(R.id.btnSignIn)
    Button btnSignIn;

    ProgressDialog loading;
    Context mContext;
    BaseApiService mBaseApiService;
    SharedPrefManager sharedPrefManager;


    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_login);
        ButterKnife.bind(this);

        mContext = this;
        mBaseApiService = UtilsApi.getAPIService();

        sharedPrefManager = new SharedPrefManager(this);

        if (Boolean.TRUE.equals(sharedPrefManager.getSpSudahLogin())) {
            startActivity(new Intent(LoginActivity.this, MainActivity.class)
                .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
            finish();
        }
    }

    @OnClick(R.id.btnSignIn)
    public void requestLogin() {
        loading = ProgressDialog.show(mContext, null, "Mohon tunggu...", true, false);
        Log.e("LOGIN", "Mulai login");
        mBaseApiService.login(etUsername.getText().toString(), etPassword.getText().toString())
            .enqueue(new Callback<ResponseBody>() {
                @Override
                public void onResponse(@NotNull Call<ResponseBody> call, @NotNull Response<ResponseBody> response) {
                    if (response.isSuccessful()) {
                        loading.dismiss();
                        try {
                            JSONObject jsonObject = new JSONObject(response.body().string());
                            Log.i("LOGIN", "JSONObject :" + jsonObject.toString());
                            if (jsonObject.getString("error").equals("false")) {

                                Log.i("LOGIN", "Login SUCCESS");
                                sharedPrefManager.saveSPBoolean(SharedPrefManager.SP_SUDAH_LOGIN, true);

                                int id = jsonObject.getJSONObject("user").getInt("id");
                                sharedPrefManager.saveSPInt(SharedPrefManager.SP_ID, id);

                                String username = jsonObject.getJSONObject("user").getString("username");
                                sharedPrefManager.saveSPString(SharedPrefManager.SP_USERNAME, username);

                                String nama_lengkap = jsonObject.getJSONObject("user").getString("nama_lengkap");
                                sharedPrefManager.saveSPString(SharedPrefManager.SP_NAMA_LENGKAP, nama_lengkap);

                                String email = jsonObject.getJSONObject("user").getString("email");
                                sharedPrefManager.saveSPString(SharedPrefManager.SP_EMAIL, email);

                                startActivity(new Intent(mContext, MainActivity.class)
                                    .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                                finish();

                            } else {
                                String error_message = jsonObject.getString("error_msg");
                                Toasty.error(mContext, error_message, Toast.LENGTH_LONG).show();
                                Log.i("LOGIN", "Login GAGAL : " + error_message);
                            }
                        } catch (JSONException | IOException e) {
                            Log.i("LOGIN", "Login GAGAL " + e.getMessage());
                        }
                    } else {
                        loading.dismiss();
                    }
                }

                @Override
                public void onFailure(Call<ResponseBody> call, Throwable t) {
                    Toasty.error(mContext, "ERROR:" + t.getMessage(), Toast.LENGTH_LONG).show();
                    Log.e("debug", "onFailure: ERROR > " + t.toString());
                    loading.dismiss();
                }
            });

    }

}
