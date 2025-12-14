# Internet Speed Test Using Static Binary Files

This repository contains pre-generated binary files that can be used to test real-world internet upload and download speeds.

## Available Test Files

- `10mb.bin` – 10 MB binary file  
- `20mb.bin` – 20 MB binary file  
- `50mb.bin` – 50 MB binary file  
- `100mb.bin` – 100 MB binary file  

All files are filled with zero bytes and have fixed sizes, making them ideal for consistent and repeatable speed tests.

## How to Use

### 1. Upload Speed Test

You can use these files to measure upload throughput to a server (e.g., your API, CDN, or storage service).

Example using `curl`:

```bash
# Upload a 50 MB file
time curl -X POST \
  -F "file=@50mb.bin" \
  [https://github.com/devhau/test-file-internet](https://github.com/devhau/test-file-internet)