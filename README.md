# rpredenomconv

> **Open-source Rupiah Redenomination Converter for Laravel (UMKM & Fintech)**  
Library Laravel untuk membantu proses **konversi, formatting, dual display, dan migrasi database otomatis** saat redenominasi rupiah (1000 : 1).

---

## ✨ Fitur Utama

- ✅ Konversi rupiah lama → rupiah baru
- ✅ Formatter Rupiah (Rp 1.000.000 → Rp 1.000)
- ✅ Dual display (Rp lama + Rp baru)
- ✅ Rounding mode (half-up, floor, ceil)
- ✅ Facade Laravel (`Redenom`)
- ✅ Artisan command migrasi database otomatis
- ✅ Dry-run (simulasi tanpa ubah data)
- ✅ Backup otomatis via kolom `_old`
- ✅ Transaction-safe
- ✅ Siap untuk UMKM, Fintech, POS, ERP, Accounting System

---

## 📦 Requirement

- PHP ≥ 8.1
- Laravel ≥ 9.x

---

## 🚀 Instalasi

### Via Composer (Dev / Local Path)
```bash
composer require kurniawanrizki/rpredenomconv:@dev

