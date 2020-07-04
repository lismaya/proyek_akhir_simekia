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

public class RiwayatImunisasiFragment extends Fragment {
    private static final String TAG = "RiwayatImunisasi";
    private RiwayatPageViewModel riwayatPageViewModel;

    Context mContext;
    BaseApiService mBaseApiService;
    SharedPrefManager sharedPrefManager;
    ProgressDialog loading;

    private RiwayatImunisasiAdapter riwayatImunisasiAdapter;
    private RecyclerView recyclerView;
    private SwipeRefreshLayout swipe;

    private static int pasien_id;

    public static RiwayatImunisasiFragment newInstance(int pasien_id) {
        RiwayatImunisasiFragment.pasien_id  = pasien_id;
        return new RiwayatImunisasiFragment();
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
        View root = inflater.inflate(R.layout.fragment_riwayat_imunisasi, container, false);
        swipe = root.findViewById(R.id.riwayat_imunisasi_swipeContainer);

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
        mBaseApiService.getRiwayatImunisasi(this.pasien_id)
            .enqueue(new Callback<RiwayatImunisasiModelList>() {
                @Override
                public void onResponse(@NotNull Call<RiwayatImunisasiModelList> call, @NotNull Response<RiwayatImunisasiModelList> response) {
                    if (response.isSuccessful()) {
                        loading.dismiss();
                        generateRiwayatImunisasiList(Objects.requireNonNull(response.body()).getRiwayatImunisasiArrayList());

                    } else {
                        loading.dismiss();
                    }
                }

                @Override
                public void onFailure(Call<RiwayatImunisasiModelList> call, Throwable t) {
                    Toasty.error(mContext, "Ada kesalahan!\n" + t.toString(), Toast.LENGTH_LONG, true).show();
                    loading.dismiss();
                }
            });

    }

    private void generateRiwayatImunisasiList(ArrayList<RiwayatImunisasiModelRecycler> riwayatImunisasiArrayList) {

        recyclerView = requireView().findViewById(R.id.recycler_view_riwayat_imunisasi_list);
        riwayatImunisasiAdapter = new RiwayatImunisasiAdapter(riwayatImunisasiArrayList);
        RecyclerView.LayoutManager layoutManager = new GridLayoutManager(getActivity(), 1);

        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(riwayatImunisasiAdapter);

    }
}
