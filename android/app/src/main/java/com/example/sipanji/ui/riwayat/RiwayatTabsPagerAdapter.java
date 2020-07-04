package com.example.sipanji.ui.riwayat;

import android.content.Context;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.annotation.StringRes;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;
import androidx.fragment.app.FragmentStatePagerAdapter;

import com.example.sipanji.R;

public class RiwayatTabsPagerAdapter extends FragmentStatePagerAdapter {

    @StringRes
    private static final int[] TAB_TITLES = new int[]{R.string.tab_pemeriksaan, R.string.tab_imunisasi};
    private final Context mContext;
    private int pasien_id;

    public RiwayatTabsPagerAdapter(int pasien_id,Context context, FragmentManager fm) {
        super(fm);
        mContext = context;
        this.pasien_id = pasien_id;
    }

    @NonNull
    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return RiwayatPemeriksaanFragment.newInstance(this.pasien_id);
            case 1:
                return RiwayatImunisasiFragment.newInstance(this.pasien_id);
            default:
                return null;
        }
    }

    @Nullable
    @Override
    public CharSequence getPageTitle(int position) {
        return mContext.getResources().getString(TAB_TITLES[position]);
    }

    @Override
    public int getCount() {
        return 2;
    }
}
