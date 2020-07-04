package com.example.sipanji.ui.home;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;


import com.example.sipanji.MainActivity;
import com.example.sipanji.R;
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

public class HomeFragment extends Fragment {

    Context mContext;
    BaseApiService mBaseApiService;
    SharedPrefManager sharedPrefManager;
    ProgressDialog loading;

    private AnakAdapter anakAdapter;
    private RecyclerView recyclerView;
    private SwipeRefreshLayout swipe;

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        mContext = context;
    }

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {

        View root = inflater.inflate(R.layout.fragment_anak, container, false);
        swipe = root.findViewById(R.id.anak_swipeContainer);

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
        mBaseApiService.getAnak(sharedPrefManager.getSpId())
            .enqueue(new Callback<AnakModelList>() {
                @Override
                public void onResponse(@NotNull Call<AnakModelList> call, @NotNull Response<AnakModelList> response) {
                    if (response.isSuccessful()) {
                        loading.dismiss();
                        generateAnakList(Objects.requireNonNull(response.body()).getAnakArrayList());

                    } else {
                        loading.dismiss();
                    }
                }

                @Override
                public void onFailure(Call<AnakModelList> call, Throwable t) {
                    Toasty.error(mContext, "Ada kesalahan!\n" + t.toString(), Toast.LENGTH_LONG, true).show();
                    loading.dismiss();
                }
            });

    }

    private void generateAnakList(ArrayList<AnakModelRecycler> anakArrayList) {

        recyclerView = requireView().findViewById(R.id.recycler_view_anak_list);
        anakAdapter = new AnakAdapter(anakArrayList);
        RecyclerView.LayoutManager layoutManager = new GridLayoutManager(getActivity(), 1);

        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(anakAdapter);

    }
}
