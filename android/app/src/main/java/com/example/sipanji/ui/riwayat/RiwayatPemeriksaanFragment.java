package com.example.sipanji.ui.riwayat;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProviders;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.example.sipanji.MainActivity;
import com.example.sipanji.R;
import com.example.sipanji.ui.home.AnakAdapter;
import com.example.sipanji.ui.home.AnakModelList;
import com.example.sipanji.util.SharedPrefManager;
import com.example.sipanji.util.api.BaseApiService;
import com.example.sipanji.util.api.UtilsApi;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import org.jetbrains.annotations.NotNull;

import java.util.ArrayList;
import java.util.Objects;

import es.dmoral.toasty.Toasty;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class RiwayatPemeriksaanFragment extends Fragment {
    private static final String TAG = "RiwayatPemeriksaan";
    private RiwayatPageViewModel riwayatPageViewModel;

    Context mContext;
    BaseApiService mBaseApiService;
    SharedPrefManager sharedPrefManager;
    ProgressDialog loading;

    private RiwayatPemeriksaanAdapter riwayatPemeriksaanAdapter;
    private RecyclerView recyclerView;
    private SwipeRefreshLayout swipe;

    private static int pasien_id;

    public static RiwayatPemeriksaanFragment newInstance(int pasien_id) {
        RiwayatPemeriksaanFragment.pasien_id  = pasien_id;
        return new RiwayatPemeriksaanFragment();
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        riwayatPageViewModel = ViewModelProviders.of(this).get(RiwayatPageViewModel.class);
        riwayatPageViewModel.setIndex(TAG);
    }


    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        mContext = context;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_riwayat_pemeriksaan, container, false);
        swipe = root.findViewById(R.id.riwayat_pemeriksaan_swipeContainer);

        Toolbar toolbar = getActivity().findViewById(R.id.toolbar);
        toolbar.setTitle("Data Anak");
        FloatingActionButton floatingActionButton = ((MainActivity) requireActivity()).getFloatingActionButton();
        if (floatingActionButton != null) {
            floatingActionButton.hide();

            floatingActionButton.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {


                }
            });
        }

        mBaseApiService = UtilsApi.getAPIService();
        sharedPrefManager = new SharedPrefManager(mContext);

        swipe.setOnRefreshListener(() -> {
            swipe.setRefreshing(false);
            loadData();
        });

        loadData();
        return root;
    }

    private void loadData() {

        loading = ProgressDialog.show(mContext, null, "Mengambil data ...", true, false);
        mBaseApiService.getRiwayatPemeriksaan(this.pasien_id)
            .enqueue(new Callback<RiwayatPemeriksaanModelList>() {
                @Override
                public void onResponse(@NotNull Call<RiwayatPemeriksaanModelList> call, @NotNull Response<RiwayatPemeriksaanModelList> response) {
                    if (response.isSuccessful()) {
                        loading.dismiss();
                        generateRiwayatPemeriksaanList(Objects.requireNonNull(response.body()).getRiwayatPemeriksaanArrayList());

                    } else {
                        loading.dismiss();
                    }
                }

                @Override
                public void onFailure(Call<RiwayatPemeriksaanModelList> call, Throwable t) {
                    Toasty.error(mContext, "Ada kesalahan!\n" + t.toString(), Toast.LENGTH_LONG, true).show();
                    loading.dismiss();
                }
            });

    }

    private void generateRiwayatPemeriksaanList(ArrayList<RiwayatPemeriksaanModelRecycler> riwayatPemeriksaanArrayList) {

        recyclerView = requireView().findViewById(R.id.recycler_view_riwayat_pemeriksaan_list);
        riwayatPemeriksaanAdapter = new RiwayatPemeriksaanAdapter(riwayatPemeriksaanArrayList);
        RecyclerView.LayoutManager layoutManager = new GridLayoutManager(getActivity(), 1);

        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(riwayatPemeriksaanAdapter);

    }
}
