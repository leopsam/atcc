/** @type {import('next').NextConfig} */
const nextConfig = {
    productionBrowserSourceMaps: false,
    images: {
        domains: ['avatars.githubusercontent.com', 'res.cloudinary.com'],
    },
}

export default nextConfig
