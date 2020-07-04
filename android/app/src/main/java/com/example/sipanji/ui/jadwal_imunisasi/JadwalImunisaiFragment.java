package com.example.sipanji.ui.jadwal_imunisasi;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.example.sipanji.MainActivity;
import com.example.sipanji.R;
import com.example.sipanji.util.api.UtilsApi;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.Objects;

public class JadwalImunisaiFragment extends Fragment {

    SwipeRefreshLayout swipe;
    private int pasien_id;

    @SuppressLint("SetJavaScriptEnabled")
    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_jadwal_imunisasi, container, false);
        swipe = root.findViewById(R.id.jadwal_imunisasi_swipeContainer);

        Bundle arguments = getArguments();
        if (arguments == null)
            Toast.makeText(getActivity(), "Arguments is NULL", Toast.LENGTH_LONG).show();
        else {
            pasien_id = getArguments().getInt("pasien_id", 0);
        }

        FloatingActionButton floatingActionButton = ((MainActivity) requireActivity()).getFloatingActionButton();
        if (floatingActionButton != null) {
            floatingActionButton.hide();
        }

        swipe.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                loadWeb(root);
            }
        });

        loadWeb(root);

        return root;
    }

    public void loadWeb(View root) {
        WebView mWebView = root.findViewById(R.id.webview_jadwal_imunisasi);
        mWebView.loadUrl(UtilsApi.BASE_URL_WEBVIEW + "jadwal-imunisasi?pasien_id=" + this.pasien_id);

        WebSettings webSettings = mWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);
        mWebView.setWebViewClient(new WebViewClient());

        mWebView.getSettings().setDomStorageEnabled(true);
        mWebView.getSettings().setAppCacheEnabled(true);
        mWebView.getSettings().setLoadsImagesAutomatically(true);
        mWebView.getSettings().setMixedContentMode(WebSettings.MIXED_CONTENT_ALWAYS_ALLOW);

        swipe.setRefreshing(true);
        mWebView.setWebViewClient(new WebViewClient() {
            public void onReceivedError(WebView view, int errorCode,
                                        String description, String failingUrl) {
                mWebView.loadUrl("file:///android_asset/error.html");
            }

            public void onPageFinished(WebView view, String url) {
                //ketika loading selesai, ison loading akan hilang
                swipe.setRefreshing(false);
            }
        });

        mWebView.setWebChromeClient(new WebChromeClient() {
            @Override
            public void onProgressChanged(WebView view, int newProgress) {
                //loading akan jalan lagi ketika masuk link lain
                // dan akan berhenti saat loading selesai
                if (100 == mWebView.getProgress()) {
                    swipe.setRefreshing(false);
                } else {
                    swipe.setRefreshing(true);
                }
            }
        });
    }
}
