import { Component } from '@angular/core';
import {BandService} from "../services/band.service";

@Component({
  selector: 'app-file-upload',
  templateUrl: './file-upload.component.html',
  styleUrls: ['./file-upload.component.scss']
})
export class FileUploadComponent {
  constructor(private bandService: BandService) { }

  file: File;

  onChange(event: Event): void {
    const element = event.currentTarget as HTMLInputElement;
    if (element.files instanceof FileList) {
      this.file = element.files[0];
    }
  }

  importFile(): void {
    this.bandService.import(this.file).subscribe({
      next: (response) => {
        if (Object.keys(response).length === 0) {
          location.reload();
        }
      },
      error: (e) => {
        if (Array. isArray(e)) {
          for (let error in e) {
            console.error(error);
          }
        }
      }
    });
  }
}
