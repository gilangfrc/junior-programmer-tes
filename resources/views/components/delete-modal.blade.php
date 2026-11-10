<!-- Reusable Global Delete Confirmation Modal -->
<div id="globalDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300 ease-out no-print">
    <!-- Modal Card -->
    <div id="globalDeleteModalCard" class="bg-white rounded-3xl border border-slate-200 shadow-2xl max-w-md w-full p-6 sm:p-7 text-center transform scale-95 transition-all duration-300 ease-out space-y-5">
        
        <!-- Danger Warning Icon -->
        <div class="mx-auto w-14 h-14 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 shadow-inner">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>

        <!-- Title & Target Text -->
        <div class="space-y-2">
            <h3 class="text-lg font-black text-slate-900 tracking-tight">Konfirmasi Hapus Data</h3>
            <p class="text-xs text-slate-500 leading-relaxed">
                Apakah Anda yakin ingin menghapus data:
            </p>
            <div id="globalDeleteTargetName" class="p-3 bg-slate-50 rounded-xl border border-slate-100 font-bold text-xs text-slate-800 break-words">
                -- Item Target --
            </div>
            <p id="globalDeleteExtraNote" class="text-[11px] text-rose-600 font-medium">
                Tindakan ini tidak dapat dibatalkan dan data akan dihapus permanen dari sistem inventaris BMD.
            </p>
        </div>

        <!-- Form & Action Buttons -->
        <form id="globalDeleteForm" method="POST" action="" class="flex items-center justify-center space-x-3 pt-2">
            @csrf
            @method('DELETE')

            <button type="button" onclick="closeDeleteModal()" class="w-1/2 px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 hover:border-slate-300 text-xs font-bold transition-all shadow-sm">
                Batal
            </button>
            <button type="submit" class="w-1/2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white text-xs font-bold transition-all shadow-md shadow-rose-600/30 flex items-center justify-center space-x-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span>Hapus Data</span>
            </button>
        </form>
    </div>
</div>

<script>
    /**
     * Buka Modal Konfirmasi Hapus Global
     * @param {string} actionUrl - URL target route DELETE (contoh: route('kendaraan-dinas.destroy', $id))
     * @param {string} targetName - Nama data yang ingin dihapus (contoh: 'KDO Plat B 1001 PQ')
     * @param {string|null} extraNote - Catatan peringatan tambahan (opsional)
     */
    function openDeleteModal(actionUrl, targetName, extraNote = null) {
        const modal = document.getElementById('globalDeleteModal');
        const card = document.getElementById('globalDeleteModalCard');
        const form = document.getElementById('globalDeleteForm');
        const nameEl = document.getElementById('globalDeleteTargetName');
        const noteEl = document.getElementById('globalDeleteExtraNote');

        form.action = actionUrl;
        nameEl.textContent = targetName;

        if (extraNote) {
            noteEl.textContent = extraNote;
        } else {
            noteEl.textContent = 'Tindakan ini tidak dapat dibatalkan dan data akan dihapus permanen dari sistem inventaris BMD.';
        }

        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
        card.classList.remove('scale-95');
        card.classList.add('scale-100');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('globalDeleteModal');
        const card = document.getElementById('globalDeleteModalCard');

        card.classList.remove('scale-100');
        card.classList.add('scale-95');
        modal.classList.remove('opacity-100', 'pointer-events-auto');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }

    // Tutup saat klik di luar card (backdrop)
    document.getElementById('globalDeleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Tutup dengan tombol Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
