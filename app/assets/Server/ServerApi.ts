import axios, {AxiosInstance} from "axios";

export default class ServerApi {
    _HOST: string = 'https://127.0.0.1/api';

    private instance: AxiosInstance = axios.create({
        baseURL: this._HOST,
        headers: {'X-API-Authentification': 'test'}
    });

    requestGet = async (url: string, params: object = {}) => {
        try {
            const response = await this.instance.get(url, {params: params});

            return await response.data;
        } catch (error: any) {
            throw new Error(error.message);
        }
    }

    myAdvertisements = async (advertisementId: number) => {
        return await this.requestGet(`/my-advertisements/${advertisementId}`);
    }

    addOffer = async (advertisementId: number, proposeId: number) => {
        return await this.requestGet(`/offer/add/${advertisementId}/${proposeId}`);
    }

    deleteOffer = async (advertisementId: number, proposeId: number) => {
        return await this.requestGet(`/offer/delete/${advertisementId}/${proposeId}`);
    }
}