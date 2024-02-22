import {Component} from '@angular/core';
import {BandService} from "../services/band.service";
import {Band} from "../models/band.model";
import {ActivatedRoute, Router} from "@angular/router";

@Component({
  selector: 'app-bands-update',
  templateUrl: './bands-update.component.html',
  styleUrls: ['./bands-update.component.scss']
})
export class BandsUpdateComponent {
  id:number;

  band: Band = {
    name: '',
    country: '',
    city: '',
    details: '',
    musicStyle: '',
  };

  constructor(
    private bandService: BandService,
    private _route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit() {
    this._route.params.subscribe(params => {
      this.id = params['id'];
    });

    this.retrieveBands();
  }

  retrieveBands(): void {
    this.bandService.get(this.id)
      .subscribe({
        next: (data) => {
          this.band = data;
        },
        error: (e) => console.error(e)
      });
  }

  saveBand(): void {
    this.bandService.update(this.id, this.band)
      .subscribe({
        next: () => {
          this.router.navigate(['bands'])
        },
        error: (e) => console.error(e)
      });
  }
}
